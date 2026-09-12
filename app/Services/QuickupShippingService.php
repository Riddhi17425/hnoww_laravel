<?php

namespace App\Services;

use App\Models\Order;
use Illuminate\Support\Facades\Http;

class QuickupShippingService
{
    protected string $baseUrl;
    protected string $apiKey;
    protected string $orderEndpoint;

    public function __construct()
    {
        $this->baseUrl = rtrim(env('QUICKUP_BASE_URL', 'https://api-ae.quiqup.com'), '/');
        $this->apiKey = (string) env('QUICKUP_API_KEY', "");
    }

    public function createOrder(Order $order): ?array
    {
        if (empty($this->apiKey)) {
            return null;
        }

        $address = $order->orderAddress;
        if (!$address) {
            return null;
        }

        $orderProducts = $order->orderProducts()->with('product')->get();

        $products = $orderProducts->map(function ($orderProduct) {
            $product = $orderProduct->product;

            return [
                'sku' => $product ? 'SKU-' . $product->id : 'ORDER-PRODUCT-' . $orderProduct->id,
                'quantity' => (int) ($orderProduct->quantity ?? 1),
                'description' => $product ? $product->product_name : 'Order Product',
                'barcode' => '',
                'selling_price' => (float) ($orderProduct->price ?? 0),
                'hs_code' => '711620',
                'country_of_origin' => 'AE',
                'weight' => (float) ($orderProduct->product->weight ?? 0.2),
                'height' => 0.1,
                'width' => 0.1,
                'length' => 0.1,
            ];
        })->values()->all();

        $payload = [
            "kind" => "partner_next_day",
            "notes" => $order->gift_note ?? "",
            "payment_amount" => (float) ($order->total_amount ?? 0),
            "payment_mode" => "pre_paid",
            // "disallowed_payment_types" => [
            //     "cash"
            // ],
            // "billing_identifier" => "rafael-company",
            // "scheduled_for" => null,
            "metadata" => null,
            "partner_order_id" => $order->order_number ?? "ORD-" . $order->id,
            // "required_documents" => [
            //     "customer_identification_photo"
            // ],
            "origin" => [
                "contact_name" => config('global_values.shipping_warehouse_details.contact_name'),
                "contact_phone" => config('global_values.shipping_warehouse_details.contact_phone'),
                "partner_order_id" => $order->order_number ?? "ORD-" . $order->id,
                "notes" => "",
                "address" => [
                    "address1" => config('global_values.shipping_warehouse_details.address1'),
                    "address2" => config('global_values.shipping_warehouse_details.address2'),
                    "country" => config('global_values.shipping_warehouse_details.country'),
                    "town" => config('global_values.shipping_warehouse_details.town'),
                ],
            ],
            "destination" => [
                "contact_name" => $address->name ?? 'Customer',
                "contact_phone" => $address->contact_no ?? "",
                "partner_order_id" => $order->order_number ?? "ORD-" . $order->id, 
                "share_tracking" => true,
                //"contact_email" => $order->user->email ?? "",
                "notes" => $order->gift_note ?? "",
                "address" => [
                    "address1" => $address->address_line1 ?? "",
                    "address2" => $address->address_line2 ?? "",
                    "country" => "",
                    "town" => $address->emirate ?? 'Dubai',
                ],
            ],
            //'products' => $products,
            "items" => [
                [
                    "name" => $order->order_number ?? "ORD-" . $order->id,
                    "quantity" => count($products) > 0 ? count($products) : 1,
                    "parcel_barcode" => 'P' . $order->id . time(),
                ],
            ],
        ];

        $response = Http::withHeaders($this->headers())->post($this->baseUrl . '/orders', $payload);
        if (!$response->successful()) {
            throw new \RuntimeException('Quickup order creation failed: ' . $response->body());
        }
        $responseData = $response->json();
        $orderId = $responseData['order']['id'] ?? null;
        \Log::info(
            'Quickup order creation response: ' . json_encode($responseData) .
            ' | Status Code: ' . $response->status()
        );
        \Log::info('orderId: ' . $orderId);
        if (!$orderId) {
            throw new \RuntimeException('Quickup order creation failed: Missing order ID in response.');
        }
        $this->generateOrderLabel((string) $orderId, $order->order_number);
        $readyResponse = $this->markOrderReadyForCollection((string) $orderId);

        return array_merge($responseData, [
            // 'ready_for_collection' => $readyResponse,
            // 'order_label' => $labelResponse,
            // 'awb' => $labelResponse['awb'] ?? $labelResponse['tracking_number'] ?? null,
        ]);
    }

    protected function headers(): array
    {
        return [
            'Authorization' => 'Bearer ' . $this->apiKey,
            'Content-Type' => 'application/json',
            'Accept' => 'application/json',
        ];
    }

    protected function markOrderReadyForCollection(string $orderId): array
    {
        $response = Http::withHeaders($this->headers())
            ->put($this->baseUrl . '/orders/' . $orderId . '/ready_for_collection');

        \Log::info('Quickup order ready_for_collection response: ' . json_encode($response->json()));

        if (!$response->successful()) {
            throw new \RuntimeException('Quickup ready_for_collection failed: ' . $response->body());
        }

        return $response->json();
    }

    protected function generateOrderLabel(string $orderId, $oNumber)
    {
        $response = Http::withHeaders($this->headers())
            ->get($this->baseUrl . '/order_label/' . $orderId);
        \Log::info('Quickup order label response: ' . json_encode($response->json()));
        if ($response->successful() && $response->header('Content-Type') === 'application/pdf' && str_starts_with($response->body(), '%PDF')
        ) {
            Storage::disk('public')->put(
                'quiqup-labels/' . $oNumber . '.pdf',
                $response->body()
            );
            \Log::info('Quickup order label saved successfully.');
        } else {
            \Log::error('Invalid Quiqup PDF response', [
                'status' => $response->status(),
                'content_type' => $response->header('Content-Type'),
                'content_disposition' => $response->header('Content-Disposition'),
                'body' => $response->body(),
            ]);
            throw new \RuntimeException('Quickup order label generation failed: ' . $response->body());
        }
    }
}
