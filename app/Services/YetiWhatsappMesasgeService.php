<?php

namespace App\Services;
use GuzzleHttp\Client;

class YetiWhatsappMesasgeService
{
    public function sendWhatsappNotification($order)
    {
        $client = new Client();

        $response = $client->post(config('global_values.whatsapp_message_api_url'), [
            'headers' => [
                'Content-Type'  => 'application/json',
                'Authorization' => 'Bearer 9vjZMwfUKVqNUbow4Gy0T9aHX338jnI0aM9bCbwK5XXZg47Tkyib8Kf5tVU5ERVJTQ09SRQ0wLOP2Qt766XJy6qfRcJYDrsQRIApxCZ8kljurukzFo30bPIoG7U4oen2rnlYm5jw',
            ],
            'json' => [
                'recipient_type' => 'individual',
                'to' => $order->user->phone,
                'type' => 'template',
                'template' => [
                    'language' => [
                        'policy' => 'deterministic',
                        'code'   => 'en',
                    ],
                    'name' => 'order_success',
                    'components' => [
                        [
                            'type' => 'header',
                            'parameters' => [
                                [
                                    'type' => 'image',
                                    'image' => [
                                        'link' => asset('/images/front/emails-banner.png'),
                                    ],
                                ],
                            ],
                        ],
                        [
                            'type' => 'body',
                            'parameters' => [
                                [
                                    'type' => 'text',
                                    'text' => $order->user->name ?? 'Customer',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $order->user->email ?? 'customer@yopmail.com',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $order->order_number ?? 'Ord-1-1-1234',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $order->status ?? 'Confirmed',
                                ],
                                [
                                    'type' => 'text',
                                    'text' => $order->order_total ?? '50000',
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ]);

        $body = $response->getBody();
        $data = json_decode($body, true);

        return $data;
    }
}
