@include('layouts.frontheader', [
    'og_image' => $og_image ? asset($og_image) : asset('public/images/front/hnoww-luxury-gifts-dubai-og-image.jpg'),
    'meta_title' => $product->meta_title ?? $product->name,
    'meta_description' => $product->meta_description ?? \Illuminate\Support\Str::limit(strip_tags($product->description), 160)
])

<style>
.pro_details_info_list ul{
     margin-bottom: 0 !important;
     padding-left: 1rem !important;
}
</style>

{{-- START - PRODUCT SCHEMA --}}
@php
    
    $schemaProductUrl = url('/product-details/' . $product->product_url);

    $schemaImages = [];
    if (!empty($product->list_page_img))
    {
        $schemaImages[] = asset(
            'public/images/admin/product_list/' . $product->list_page_img
        );
    }

    $schemaImages = array_values(array_unique($schemaImages));

    $schemaDescription = trim(
        strip_tags($product->meta_description ?? '')
    );

    if (empty($schemaDescription))
    {
        $schemaDescription = trim(
            strip_tags($product->short_description ?? '')
        );
    }

    // PRODUCT MATERIAL

    $schemaMaterial = [];

    if (!empty($product->materials))
    {
        $materialHtml = $product->materials;

        // Extract each <li>
        preg_match_all(
            '/<li[^>]*>(.*?)<\/li>/is',
            $materialHtml,
            $materialMatches
        );

        if (!empty($materialMatches[1]))
        {
            foreach ($materialMatches[1] as $material)
            {
                $material = trim(strip_tags($material));
                $material = preg_replace('/\s+/', ' ', $material);
                if (!empty($material))
                {
                    $schemaMaterial[] = $material;
                }
            }
        }
        else
        {
            $material = trim(
                preg_replace(
                    '/\s+/',
                    ' ',
                    strip_tags($materialHtml)
                )
            );

            if (!empty($material))
            {
                $schemaMaterial[] = $material;
            }
        }
    }


    // PRODUCT WEIGHT

    $schemaWeight = null;
    if (!empty($product->weight))
    {
        $weightText = strtolower(
            trim(strip_tags($product->weight))
        );

        preg_match(
            '/([0-9]+(?:\.[0-9]+)?)/',
            $weightText,
            $weightMatch
        );

        if (!empty($weightMatch[1]))
        {
            $weightValue = round((float) $weightMatch[1], 2);

            if (
                str_contains($weightText, 'gms') ||
                str_contains($weightText, 'gram') ||
                preg_match('/\bg\b/', $weightText)
            )
            {
                $weightValue = $weightValue / 1000;
            }

            $schemaWeight = [
                '@type' => 'QuantitativeValue',
                'value' => $weightValue,
                'unitCode' => 'KGM',
            ];
        }
    }

    // PRODUCT DIMENSIONS

    $schemaHeight = null;
    $schemaWidth  = null;
    $schemaDepth  = null;
    
    // Height
    if ($product->height !== null && $product->height !== '')
    {
        $schemaHeight = [
            '@type' => 'QuantitativeValue',
            'value' => (float) $product->height,
            'unitText' => 'in',
        ];
    }
    
    // Width
    if ($product->width !== null && $product->width !== '')
    {
        $schemaWidth = [
            '@type' => 'QuantitativeValue',
            'value' => (float) $product->width,
            'unitText' => 'in',
        ];
    }
    
    // Depth
    // Database column is "length", but schema property is "depth"
    if ($product->length !== null && $product->length !== '')
    {
        $schemaDepth = [
            '@type' => 'QuantitativeValue',
            'value' => (float) $product->length,
            'unitText' => 'in',
        ];
    }
    
    // PRODUCT PRICE

    $schemaPrice = preg_replace(
        '/[^0-9.]/',
        '',
        $product->product_price ?? ''
    );

    $schemaPrice = $schemaPrice !== '' ? (float) $schemaPrice : null;

    // PRODUCT AVAILABILITY

    $schemaAvailability =
        ((int) ($product->product_stock ?? 0) > 0)
            ? 'https://schema.org/InStock'
            : 'https://schema.org/OutOfStock';


    // PRODUCT SCHEMA

    $productSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Product',
        '@id' => $schemaProductUrl . '#product',
        'name' => $product->meta_title ?? '',
        'description' => $schemaDescription,
        'url' => $schemaProductUrl,
        'image' => $schemaImages,
        'brand' => [
            '@type' => 'Brand',
            'name' => 'HNOWW',
        ],
    ];

    // MATERIAL
    if (!empty($schemaMaterial))
    {
        $productSchema['material'] = $schemaMaterial;
    }

    //  WEIGHT
    if (!empty($schemaWeight))
    {
        $productSchema['weight'] = $schemaWeight;
    }

    // HEIGHT
    if (!empty($schemaHeight))
    {
        $productSchema['height'] = $schemaHeight;
    }

    // WIDTH
    if (!empty($schemaWidth))
    {
        $productSchema['width'] = $schemaWidth;
    }

    // DEPTH
    if (!empty($schemaDepth))
    {
        $productSchema['depth'] = $schemaDepth;
    }

    // OFFER
    if (!empty($schemaPrice))
    {
        $productSchema['offers'] = [
            '@type' => 'Offer',
            '@id' => $schemaProductUrl . '#offer',
            'url' => $schemaProductUrl,
            'price' => $schemaPrice,
            'priceCurrency' => 'AED',
            'availability' => $schemaAvailability,
            'itemCondition' => 'https://schema.org/NewCondition',
           
            // SHIPPING DETAILS
            'shippingDetails' => [
                [
                    '@type' => 'OfferShippingDetails',
                    'shippingDestination' => [
                        '@type' => 'DefinedRegion',
                        'addressCountry' => 'AE',
                        'addressRegion' => 'Dubai',
                    ],

                    'deliveryTime' => [
                        '@type' => 'ShippingDeliveryTime',
                        'handlingTime' => [
                            '@type' => 'QuantitativeValue',
                            'minValue' => 0,
                            'maxValue' => 1,
                            'unitCode' => 'DAY',
                        ],
                        'transitTime' => [
                            '@type' => 'QuantitativeValue',
                            'minValue' => 2,
                            'maxValue' => 3,
                            'unitCode' => 'DAY',
                        ],
                    ],
                ],
                [
                    '@type' => 'OfferShippingDetails',
                    'shippingDestination' => [
                        '@type' => 'DefinedRegion',
                        'addressCountry' => 'AE',
                    ],
                    'deliveryTime' => [
                        '@type' => 'ShippingDeliveryTime',
                        'handlingTime' => [
                            '@type' => 'QuantitativeValue',
                            'minValue' => 0,
                            'maxValue' => 1,
                            'unitCode' => 'DAY',
                        ],
                        'transitTime' => [
                            '@type' => 'QuantitativeValue',
                            'minValue' => 6,
                            'maxValue' => 7,
                            'unitCode' => 'DAY',
                        ],
                    ],
                ],
            ],
        ];
    }
@endphp

<script type="application/ld+json">
{!! json_encode(
    $productSchema,
    JSON_UNESCAPED_SLASHES |
    JSON_UNESCAPED_UNICODE |
    JSON_PRETTY_PRINT
) !!}
</script>
{{-- END - PRODUCT SCHEMA --}}

{{-- START - BREADCRUMBS SCHEMA --}}
{{-- BREADCRUMB SCHEMA --}}
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "BreadcrumbList",
    "@id": "{{ url()->current() }}#breadcrumb",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ url('/') }}"
        },
        {
            "@type": "ListItem",
            "position": 2,
            "name": {!! json_encode($product->product_name ?? '') !!},
            "item": "{{ url('/product-details/' . ($product->product_url ?? '')) }}"
        }
    ]
}
</script>
{{-- END - BREADCRUMBS SCHEMA --}}

<style>
.theme-green .header-scrolled {
    background: #EDEAE4;
}

.theme-green .language-select .dropdown-input-lan {
    color: #0e2233;
}

.delivery-info {
    margin-top: 0.75rem;
    padding: 16px 18px;
    background: linear-gradient(135deg, #fffdf9 0%, #f5efe7 100%);
    border: 1px solid #e7d7b6;
    border-radius: 14px;
    box-shadow: 0 8px 18px rgba(9, 25, 35, 0.04);
}

.delivery-header {
    display: flex;
    align-items: center;
    gap: 10px;
    margin-bottom: 10px;
    padding-bottom: 8px;
    border-bottom: 1px solid rgba(181, 138, 70, 0.2);
}

.delivery-header svg {
    width: 20px;
    height: 20px;
    color: #b58a46;
    flex-shrink: 0;
}

.delivery-title {
    margin: 0;
    font-size: 15px;
    font-weight: 700;
    color: #0e2233;
    letter-spacing: 0.2px;
}

.delivery-list {
    display: grid;
    gap: 8px;
}

.delivery-row {
    display: flex;
    align-items: baseline;
    flex-wrap: wrap;
    gap: 6px;
    line-height: 1.6;
    color: #0e2233;
    padding: 2px 0;
}

.delivery-label {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-weight: 700;
    min-width: 140px;
    color: #0e2233;
}

.delivery-label svg {
    width: 15px;
    height: 15px;
    color: #b58a46;
    flex-shrink: 0;
}

.delivery-value {
    color: #574d3d;
}

.add_to_cart_btn
{
    background: var(--secondary-color) !important;
    color: var( --white-color) !important;
}

.product-stock-status {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    margin: 4px 0 0;
    color: #8a5148;
    font-size: 14px;
    font-weight: 600;
}

.product-stock-status::before {
    content: "";
    width: 8px;
    height: 8px;
    border-radius: 50%;
    background: #8a5148;
}

.product-stock-status.is-out-of-stock {
    color: #8a5148;
}

.product-stock-status.is-out-of-stock::before {
    background: #b85c50;
}

.pro_details_right .increment_decrement_area {
    flex-wrap: wrap;
}

.pro_details_right .whatsapp_inquiry_row {
    flex: 0 0 100%;
}

.pro_details_right .whatsapp_inquiry_btn {
    display: inline-flex;
    width: fit-content;
    max-width: 100%;
    align-items: center;
    justify-content: center;
    gap: 10px;
    min-height: 44px;
    margin-left: 0;
    padding: 9px 16px;
    color: #27785b;
    background: #f4f8f3;
    border: 1px solid #b8cbb9;
    border-radius: 3px;
    font-size: 13px;
    letter-spacing: 0.03em;
    text-decoration: none;
    transition: background-color 0.2s ease, border-color 0.2s ease, color 0.2s ease;
}

.pro_details_right .whatsapp_inquiry_btn svg {
    flex: 0 0 18px;
    width: 18px;
    height: 18px;
    color: #20a66a;
}

.pro_details_right .whatsapp_inquiry_btn:hover {
    color: #fff;
    background: #27785b;
    border-color: #27785b;
}

.pro_details_right .whatsapp_inquiry_btn:hover svg {
    color: #fff;
}

.pro_details_right .whatsapp_inquiry_btn::before,
.pro_details_right .whatsapp_inquiry_btn::after {
    content: none;
}

.out_of_stock_btn {
    color: #8a3327;
    background: #f8e9e6;
    border: 1px solid #c66b5e;
    font-weight: 700;
    opacity: 1;
    cursor: not-allowed;
    pointer-events: none;
}

.whatsapp_inquiry_btn {
    display: inline-flex;
    align-items: center;
    justify-content: center;
    gap: 8px;
}

.whatsapp_inquiry_btn svg {
    flex-shrink: 0;
    color: #25D366;
}

@media (max-width:767px) {
    .sticky-header {
        /*background: #EDEAE4;*/
    }

    .delivery-info {
        padding: 14px 12px;
    }

    .delivery-header {
        align-items: flex-start;
        margin-bottom: 8px;
    }

    .delivery-row {
        display: block;
        line-height: 1.7;
    }

    .delivery-label {
        display: flex;
        min-width: auto;
        margin-bottom: 2px;
    }

    .pro_details_right .whatsapp_inquiry_row {
        margin-top: 4px;
    }

}
</style>

<section class="mt_60">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="pro_details">
                    <div class="left nav flex-column" id="productTab" role="tablist">
                        @if(isset($productDetailImages) && $productDetailImages != '')
                        @foreach($productDetailImages as $key => $val)
                        <button class="nav-link @if($key == 0) active @endif" data-bs-toggle="tab"
                            data-bs-target="#img1_{{ $key }}">
                            @php
                                $imagePath = public_path('images/admin/product_detail/' . $val);
                            @endphp
                            @if(isset($val) && $val != '' && file_exists($imagePath))
                                <img src="{{ asset('public/images/admin/product_detail/'.$val)}}" alt="{{ $product->product_name ?? '' }}">
                            @else
                                <img class="img-fluid" src="{{asset('public/noimg.jpg')}}" alt="no image found">
                            @endif
                        </button>
                        @endforeach
                        @endif
                    </div>

                    <div class="tab-content">
                        @if(isset($productDetailImages) && $productDetailImages != '')
                        @foreach($productDetailImages as $key => $val)
                        <div class="tab-pane fade show @if($key == 0) active @endif" id="img1_{{ $key }}">
                            <div class="zoom-container">
                                @php
                                    $imagePath = public_path('images/admin/product_detail/' . $val);
                                @endphp
                                @if(isset($val) && $val != '' && file_exists($imagePath))
                                    <img class="zoom-image img-fluid" src="{{ asset('public/images/admin/product_detail/'.$val)}}"
                                    alt="{{ $product->product_name ?? '' }}">
                                    <div class="zoom-lens"></div>
                                @else
                                    <img class="img-fluid" src="{{asset('public/noimg.jpg')}}" alt="no image found">
                                    <div class="zoom-lens"></div>
                                @endif
                                {{-- <div class="zoom-lens"></div> --}}
                            </div>
                        </div>
                        @endforeach
                        @endif
            </div>

        </div>
    </div>
    <div class="col-lg-5">
        <div class="pro_details_right">
            <h2 class="main_head">{{ $product->product_name ?? '' }}</h2>
            <p class="">{{ $product->short_note ?? '' }}</p>
            <!--<p class="sub_head_inter para">{!! $product->short_description ?? '' !!}</p>-->
            <h4 class="sub_head_inter">AED {{ $product->product_price ?? '' }} @if(isset($product->moq)) | MOQ
                {{$product->moq }} @endif</h4>

            @php $availableStock = (int) ($product->product_stock ?? 0); @endphp
            <p class="{{ $availableStock > 0 && $availableStock <= 5 ? 'product-stock-status' : '' }}" role="status">
                @if($availableStock > 0 && $availableStock <= 5)
                    Only {{ $availableStock }} {{ \Illuminate\Support\Str::plural(' Product', $availableStock) }} left in Stock
                @else
                    <!-- Out of Stock -->
                @endif
            </p>

            {{-- <div class="increment_decrement_area">
                <div class="increment_decrement">
                    <button class="dec_btn"><svg width="16" height="2" viewBox="0 0 16 2" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M0.75 0.75H14.75" stroke="#666666" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>

                            <span class="span_value">1</span>

                            <button class="inc_btn"><svg width="18" height="18" viewBox="0 0 18 18" fill="none"
                                    xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.75 0.75V16.75M0.75 8.75H16.75" stroke="#666666" stroke-width="1.5"
                                        stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </button>
                        </div>
                    @auth
                        <a href="" class="com_btn">Add to Cart </a>
                    @else
                        <a href="javascript:void(0)" class="com_btn" data-bs-toggle="modal" data-bs-target="#loginRequiredModal">
                            Add to Cart
                        </a>
                    @endauth
                    <!--<a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#productInquiry">Enquire Now </a>-->
                </div>
            </div> --}}

            <div class="increment_decrement_area">
                <div class="increment_decrement" data-product-id="{{ $product->id }}" data-stock="{{ $product->product_stock }}">
                    <button class="dec_btn" data-call="detail" type="button">−</button>
                    <span class="span_value">1</span>
                    <input type="hidden" class="qty_input" id="product-qty" value="1">
                    <button class="inc_btn" data-call="detail" type="button">+</button>
                </div>
                    @if((int) ($product->product_stock ?? 0) <= 0)
                        <button type="button" class="com_btn out_of_stock_btn" disabled>Out of Stock</button>
                        <div class="whatsapp_inquiry_row">
                        <a href="https://wa.me/971502243720?text={{ urlencode('Hi, I am interested in ' . ($product->product_name ?? 'this product') . ' which is currently out of stock. Can you help?') }}" target="_blank" rel="noopener" class="com_btn whatsapp_inquiry_btn">
                            <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.6528 0C14.7445 0 17.6523 1.20025 19.8392 3.3874L20.2336 3.79825C21.1279 4.7808 21.8462 5.9126 22.3554 7.14292C22.9368 8.54807 23.2327 10.0547 23.228 11.5754C23.228 17.9521 18.0411 23.1397 11.6638 23.1397C9.81895 23.1397 8.01534 22.7023 6.38485 21.8603L0.885306 23.3051C0.641222 23.3692 0.381616 23.2971 0.20424 23.1176C0.0270453 22.9384 -0.0415868 22.6783 0.0250131 22.4352L1.49468 17.0887C0.638224 15.5084 0.16176 13.7503 0.104976 11.9545L0.0994616 11.5754C0.0886639 5.18708 5.27647 0.00013398 11.6528 0ZM11.6528 1.41176C6.05625 1.41189 1.5012 5.96637 1.51122 11.574V11.5768C1.50895 13.3563 1.97663 15.1056 2.86509 16.6475C2.9589 16.8107 2.98391 17.005 2.93401 17.1865L1.71113 21.6272L6.29248 20.4265L6.42483 20.4044C6.55816 20.3955 6.69205 20.4248 6.81086 20.4899C8.29677 21.3045 9.95906 21.7279 11.6638 21.7279C17.2615 21.7279 21.8163 17.1724 21.8163 11.5754C21.8207 10.2405 21.5602 8.91543 21.0498 7.68199C20.5395 6.44904 19.7898 5.3295 18.844 4.38833L18.8425 4.38695C16.921 2.46484 14.3718 1.41176 11.6528 1.41176ZM8.78106 5.36496L8.88584 5.36635C9.01773 5.37263 9.22246 5.40063 9.43179 5.52075C9.71006 5.68058 9.89593 5.94108 10.0301 6.24457C10.1588 6.53059 10.3574 7.01561 10.5237 7.42747C10.6084 7.63716 10.6862 7.83029 10.747 7.97893L10.8353 8.19538L10.8477 8.21883C10.9601 8.44368 11.1006 8.8621 10.8711 9.32314C10.8658 9.3339 10.8591 9.34439 10.8532 9.35485C10.8029 9.44406 10.6906 9.6948 10.5003 9.91874L10.4989 9.92149C10.4276 10.0046 10.2853 10.1738 10.1584 10.3158C10.3558 10.6238 10.6977 11.1276 11.1551 11.5924L11.4157 11.8392C12.2617 12.595 12.9526 12.8657 13.3224 13.0263C13.3996 12.938 13.5005 12.8263 13.6009 12.705C13.7752 12.4944 13.9235 12.3044 13.9856 12.2073L13.9925 12.1949C14.1578 11.9474 14.4109 11.7288 14.7755 11.6876C15.0578 11.6557 15.3162 11.753 15.418 11.7882H15.4208C15.5975 11.85 16.0429 12.0645 16.4161 12.2459L17.3481 12.7023L17.3797 12.7188C17.4355 12.7491 17.4887 12.7752 17.5439 12.8029C17.595 12.8287 17.659 12.8612 17.7162 12.8925C17.7817 12.9284 17.9236 13.0053 18.0499 13.1407L18.1684 13.2965C18.2333 13.4053 18.2607 13.5124 18.2732 13.5695C18.2881 13.6373 18.2961 13.7056 18.3008 13.7666C18.31 13.8891 18.3085 14.0263 18.2967 14.1692C18.2724 14.4572 18.2042 14.8123 18.0733 15.1853L18.0719 15.1908C17.8741 15.7378 17.3714 16.154 16.9717 16.4109C16.6123 16.6419 16.1789 16.8431 15.8068 16.9196L15.6523 16.9459C15.4449 16.9692 15.0982 17.0443 14.526 16.9679C13.9782 16.8948 13.2267 16.6888 12.0568 16.2276L12.0554 16.2261C10.5368 15.6245 9.32466 14.5601 8.49015 13.6549C8.06966 13.1988 7.73578 12.7741 7.49888 12.4514C7.38021 12.2897 7.28662 12.1526 7.21763 12.0515C7.18354 12.0016 7.15488 11.9598 7.13492 11.9302C7.12049 11.9088 7.11281 11.8984 7.1101 11.8944C7.03215 11.7906 6.72918 11.3856 6.4442 10.8231C6.16182 10.2658 5.86516 9.4925 5.86516 8.66552C5.86533 7.03579 6.74161 6.20618 7.00256 5.92333C7.41344 5.47654 7.91463 5.35394 8.25027 5.35394C8.418 5.35394 8.60208 5.355 8.78106 5.36496ZM8.22545 6.76846C8.2117 6.77104 8.19456 6.77482 8.17582 6.78225C8.13954 6.79668 8.09113 6.82383 8.0407 6.87876C7.7928 7.14749 7.27708 7.62334 7.27693 8.66552C7.27693 9.17547 7.46761 9.71763 7.70431 10.1848C7.82033 10.4138 7.93988 10.6107 8.03795 10.7597L8.24061 11.0479L8.24199 11.0493C8.42754 11.2976 10.0437 13.9106 12.5752 14.9136L13.3307 15.1963C14.0007 15.4308 14.4265 15.5289 14.7135 15.5671C15.0712 15.6149 15.2056 15.5748 15.4952 15.5423C15.5898 15.5318 15.8852 15.4322 16.2092 15.2239C16.5441 15.0086 16.7103 14.8049 16.7443 14.711C16.8323 14.4582 16.8731 14.2248 16.8876 14.0534C16.8438 14.0313 16.7933 14.0053 16.7387 13.9762L15.7984 13.5157C15.6008 13.4195 15.4062 13.3253 15.247 13.251C15.1674 13.2138 15.0986 13.1825 15.0444 13.1586L15.0388 13.1559C14.7828 13.5024 14.3773 13.9783 14.2351 14.1305L14.2323 14.1293C14.0801 14.297 13.8578 14.4624 13.5485 14.4987C13.2619 14.532 13.0113 14.4405 12.8275 14.3498C12.6019 14.2421 11.6086 13.9046 10.4768 12.8939L10.1556 12.5892C9.44362 11.8668 8.97548 11.09 8.83345 10.8631C8.82723 10.8532 8.82124 10.843 8.81552 10.8328C8.66476 10.5623 8.5994 10.2421 8.71763 9.91735C8.80646 9.67356 8.97733 9.50848 9.05541 9.4362L9.4249 9.00468C9.45361 8.97089 9.4728 8.94262 9.49659 8.8999C9.51099 8.87403 9.52419 8.84688 9.54622 8.80476C9.54985 8.79781 9.5533 8.79022 9.55725 8.78271C9.52107 8.70284 9.47592 8.60138 9.44006 8.51386C9.37741 8.36091 9.29761 8.16259 9.21397 7.9555C9.04354 7.53358 8.85858 7.07875 8.74383 6.8236L8.74108 6.81809C8.73339 6.80057 8.72406 6.78672 8.71763 6.77398C8.58397 6.76583 8.43563 6.7657 8.25027 6.7657H8.24338C8.23907 6.7661 8.23237 6.76717 8.22545 6.76846Z" fill="currentColor" />
                            </svg>
                            Contact Us on WhatsApp
                        </a>
                        </div>
                    @else
                        <button type="button" class="com_btn add_to_cart_btn" data-product-id="{{ $product->id }}" id="cartSubmitBtn"> Add to Cart</button>
                        @php
                            $waNo  = preg_replace('/\D/', '', config('global_values.admin_whatsapp_no'));
                            $waMsg = 'Hi, I would like to order ' . $product->product_name . ' (' . url()->current() . ')';
                        @endphp
                        <style>
                            .pro_details_right .wa_order { position: relative; overflow: hidden; width: fit-content; min-height: 0; margin: 0; padding: 4px 16px 4px 4px; gap: 8px; border: 1px solid #cfe3d3; border-radius: 50px; background: #eaf8ed; color: #1f6b4a; font-size: 13px; font-weight: 600; transition: .2s; }
                            .pro_details_right .wa_order svg { flex: 0 0 28px; width: 28px; height: 28px; padding: 5px; border-radius: 50%; background: #25D366; color: #fff; animation: waPulse 2s infinite; }
                            .pro_details_right .wa_order::after { content: ""; position: absolute; top: 0; left: -60%; width: 40%; height: 100%; background: linear-gradient(110deg, transparent, rgba(255, 255, 255, .7), transparent); transform: skewX(-20deg); }
                            .pro_details_right .wa_order:hover { padding: 4px 16px 4px 4px; color: #1f6b4a; background: #d6efdc; border-color: #25D366; transform: translateY(-2px); box-shadow: 0 8px 16px rgba(37, 211, 102, .25); }
                            .pro_details_right .wa_order:hover::after { left: 130%; transition: left .6s; }
                            @keyframes waPulse { from { box-shadow: 0 0 0 0 rgba(37, 211, 102, .55); } to { box-shadow: 0 0 0 8px rgba(37, 211, 102, 0); } }
                        </style>
                        <div class="whatsapp_inquiry_row" style="margin-top: -4px;">
                            <a href="https://wa.me/{{ $waNo }}?text={{ urlencode($waMsg) }}" target="_blank" rel="noopener"
                                class="com_btn whatsapp_inquiry_btn wa_order" data-msg="{{ $waMsg }}">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 11.5a8.4 8.4 0 0 1-12.4 7.4L3 20.5l1.7-5.4A8.5 8.5 0 1 1 21 11.5z"></path>
                                    <path d="M9 8.5c.3 2.6 2.9 5.2 5.5 5.5l1.2-1.2-2-1-.8.8c-.8-.4-1.9-1.5-2.3-2.3l.8-.8-1-2z"></path>
                                </svg>
                                Order on WhatsApp
                            </a>
                        </div>
                        <script>
                            document.querySelector('.wa_order').addEventListener('click', function () {
                                var qty = parseInt(document.getElementById('product-qty').value, 10) || 1;
                                this.href = this.href.split('?')[0] + '?text=' + encodeURIComponent(this.dataset.msg + '. Quantity: ' + qty + '. Please help me.');
                            });
                        </script>
                    @endif

                    {{-- <button type="button" class="com_btn buy_now_btn" data-product-id="{{ $product->id }}" id="buyNowBtn"> Buy Now</button> --}}
                {{-- @endif --}}
            </div>
            {{-- <div class="increment_decrement_area">
                <a href="#" class="com_btn" data-bs-toggle="modal" data-bs-target="#productInquiry">Enquire Now </a>
            </div> --}}
            
            @php
                $dimensionFields = [
                    'Height' => $product->height ? $product->height . ' cm' : null,
                    'Width' => $product->width ? $product->width . ' cm' : null,
                    'Length' => $product->length ? $product->length . ' cm' : null,
                ];
                $accPin = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path><circle cx="12" cy="10" r="3"></circle></svg>';
                $accRows = fn ($a, $b) => '<div class="delivery-list">'
                    . '<div class="delivery-row"><span class="delivery-label">' . $accPin . 'Dubai:</span><span class="delivery-value">' . $a . '</span></div>'
                    . '<div class="delivery-row"><span class="delivery-label">' . $accPin . 'Other Emirates:</span><span class="delivery-value">' . $b . '</span></div>'
                    . '</div>';

                // inner svg paths per section (24x24, stroke icons)
                $accIcons = [
                    'The Story' => '<path d="M4 5a2 2 0 0 1 2-2h13v16H6a2 2 0 0 0-2 2z"></path><path d="M8 7h7M8 11h5"></path>',
                    'Material' => '<path d="m12 3 9 5-9 5-9-5z"></path><path d="m3 13 9 5 9-5"></path>',
                    'Weight' => '<path d="M6 8h12l2 12H4z"></path><circle cx="12" cy="5" r="2"></circle>',
                    'Dimensions' => '<path d="M3 17 17 3l4 4L7 21z"></path><path d="m7 13 2 2M10 10l2 2M13 7l2 2"></path>',
                    'Care and maintenance' => '<path d="M12 21s-8-5.5-8-11a4.5 4.5 0 0 1 8-2.8A4.5 4.5 0 0 1 20 10c0 5.5-8 11-8 11z"></path>',
                    'Delivery Charges' => '<path d="M1 3h15v13H1z"></path><path d="M16 8h4l3 3v5h-7z"></path><circle cx="5.5" cy="18.5" r="2.5"></circle><circle cx="18.5" cy="18.5" r="2.5"></circle>',
                    'Estimated Delivery' => '<rect x="3" y="4" width="18" height="18" rx="2"></rect><path d="M16 2v4M8 2v4M3 10h18"></path><path d="m9 16 2 2 4-4"></path>',
                    'Returns' => '<path d="M3 12a9 9 0 1 0 3-6.7"></path><path d="M3 4v5h5"></path>',
                ];

                // [title, html body] - sections without content are skipped
                $accordionItems = [];
                if (!empty($product->large_description)) {
                    $accordionItems['The Story'] = '<div>' . $product->large_description . '</div>';
                }
                if (!empty($product->materials)) {
                    $accordionItems['Material'] = '<div class="pro_details_info_list">' . $product->materials . '</div>';
                }
                if (!empty($product->weight)) {
                    $accordionItems['Weight'] = '<div class="pro_details_info_list">' . e($product->weight) . '</div>';
                }
                if (array_filter($dimensionFields)) {
                    $li = '';
                    foreach (array_filter($dimensionFields) as $label => $value) {
                        $li .= '<li><b>' . $label . ':</b> ' . e($value) . '</li>';
                    }
                    $accordionItems['Dimensions'] = '<div class="pro_details_info_list"><ul class="mb-0 ps-3">' . $li . '</ul></div>';
                }
                if (!empty($product->care_maintenance)) {
                    $accordionItems['Care and maintenance'] = '<p class="m-0">' . $product->care_maintenance . '</p>';
                }
                $accordionItems['Delivery Charges'] = $accRows('30 Dirham', '50 Dirham');
                $accordionItems['Estimated Delivery'] = $accRows('Within 2-3 business days', 'Within 6-7 business days');
                // Returns is shown as a link row (see loop below), body unused
                $accordionItems['Returns'] = '';
            @endphp

            <style>
                .pd_accordion { margin-top: 1rem; }
                .pd_accordion .accordion-item { margin-bottom: 6px; background: linear-gradient(135deg, #fffdf9 0%, #f5efe7 100%); border: 1px solid #e7d7b6; border-radius: 14px !important; overflow: hidden; box-shadow: 0 6px 14px rgba(9, 25, 35, .04); transition: box-shadow .2s, border-color .2s; }
                .pd_accordion .accordion-item:hover, .pd_accordion .accordion-item:has(.show) { border-color: #b58a46; box-shadow: 0 8px 18px rgba(181, 138, 70, .15); }
                .pd_accordion .accordion-button { gap: 10px; padding: 8px 12px; font-size: 14px; background: transparent; box-shadow: none; color: #0e2233; }
                .pd_accordion .accordion-button:not(.collapsed) { color: #b58a46; border-bottom: 1px solid rgba(181, 138, 70, .2); }
                .pd_accordion .accordion-button::after { background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='none' stroke='%23b58a46' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpath d='m4 6 4 4 4-4'/%3E%3C/svg%3E"); }
                .pd_accordion .acc_icon { display: inline-flex; flex: 0 0 28px; width: 28px; height: 28px; padding: 6px; border-radius: 50%; background: #f1e6d0; color: #b58a46; transition: .2s; }
                .pd_accordion .accordion-button:not(.collapsed) .acc_icon { background: #b58a46; color: #fff; }
                .pd_accordion .accordion-button .sub_head { margin: 0; font-size: 14px; font-weight: 700; }
                .pd_accordion .accordion-body { padding: 10px 12px 12px; font-size: 14px; }
                .pd_accordion .pd_acc_link::after { transform: rotate(-90deg); }
                .pd_accordion .delivery-label svg { width: 16px; height: 16px; color: #b58a46; }
            </style>
            <div class="accordion pd_accordion" id="productAccordion">
                @foreach($accordionItems as $title => $body)
                    @php $accId = 'pdAcc' . $loop->index; @endphp
                    @if($title === 'Returns')
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <a href="{{ route('front.return.policy') }}" class="accordion-button collapsed pd_acc_link text-decoration-none">
                                <svg class="acc_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $accIcons[$title] ?? '' !!}</svg>
                                <span class="sub_head">Returns available within 14 days</span>
                            </a>
                        </h2>
                    </div>
                    @continue
                    @endif
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#{{ $accId }}" aria-expanded="false" aria-controls="{{ $accId }}">
                                <svg class="acc_icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">{!! $accIcons[$title] ?? '' !!}</svg>
                                <span class="sub_head">{{ $title }}</span>
                            </button>
                        </h2>
                        <div id="{{ $accId }}" class="accordion-collapse collapse" data-bs-parent="#productAccordion">
                            <div class="accordion-body">{!! $body !!}</div>
                        </div>
                    </div>
                @endforeach
            </div>

            @if((int) ($product->product_stock ?? 0) > 0)
                <style>
                    @media (max-width: 767px) {
                        #sticky-cart-bar { display: none !important; }
                        body { padding-bottom: 84px; }
                        .wa-container { bottom: 96px !important; }
                    }
                </style>
                <div class="d-md-none position-fixed bottom-0 start-0 end-0 bg-white text-center px-3 pt-2 pb-1"
                    style="z-index: 1040; border-radius: 14px 14px 0 0; box-shadow: 0 -4px 16px rgba(0,0,0,.12);">
                    <button type="button" class="w-100 border-0 rounded py-3 fs-5 fw-semibold text-white"
                        style="background: rgb(140 138 114);" onclick="cartSubmitBtn.click()">Add to cart</button>
                    <small class="d-block mt-1" style="color: #574d3d;">@php
                            $dlvFrom = \Carbon\Carbon::now('Asia/Dubai')->addWeekdays(2);
                            $dlvTo = \Carbon\Carbon::now('Asia/Dubai')->addWeekdays(3);
                            $dlvRange = $dlvFrom->format('M') === $dlvTo->format('M')
                                ? $dlvFrom->format('j') . ' - ' . $dlvTo->format('j M')
                                : $dlvFrom->format('j M') . ' - ' . $dlvTo->format('j M');
                        @endphp
                        Estimated Delivery in Dubai: {{ $dlvRange }}</small>
                </div>
            @endif

        </div>
    </div>
    </div>
</section>

@if(isset($productTab) && is_countable($productTab) && count($productTab) > 0)
<section class="mt_60 mb-5">
    <div class="container">
        <div class="modern-tabs">
            <ul class="nav nav-tabs" id="filledTabs" role="tablist">
                @foreach($productTab as $key => $val)
                <li class="nav-item" role="presentation">
                    <button class="nav-link @if($key == 0) active @endif" {{-- ✅ first tab active --}}
                        id="tab-{{ $key }}" {{-- ✅ unique ID --}} data-bs-toggle="tab"
                        data-bs-target="#tab-content-{{ $key }}" {{-- ✅ unique target --}} type="button" role="tab"
                        aria-controls="tab-content-{{ $key }}" aria-selected="@if($key == 0) true @else false @endif">
                        {{ $val->title ?? '' }}
                    </button>
                </li>
                @endforeach
                <!-- TAB 2 -->
                {{-- <li class="nav-item" role="presentation">
                    <button class="nav-link" id="tab-3" data-bs-toggle="tab" data-bs-target="#tab-content-3"
                        type="button" role="tab" aria-controls="tab-content-3" aria-selected="false">
                        Materials & Craft
                    </button>
                </li> --}}

            </ul>

            <div class="tab-content" id="filledTabsContent">
                @foreach($productTab as $key => $val)
                <div class="tab-pane fade @if($key == 0) show active @endif" {{-- ✅ only first tab active --}}
                    id="tab-content-{{ $key }}" role="tabpanel" aria-labelledby="tab-{{ $key }}">
                    {!! $val->details ?? '' !!}
                </div>
                @endforeach
                {{-- <div class="tab-pane fade" id="tab-content-3" role="tabpanel" aria-labelledby="tab-3">
                    <h4 class="sub_head mb-4">Ritual / Use</h4>
                    <ul class="pro_details_info_list mb-0">
                        <li><b>The Centerpiece: </b>Place the hammered bowl on a coffee table or console to ground the
                            space with warm metal tones.</li>
                        <li><b>The Awakening: </b>Light the Illumi burner during evening gatherings to fill the room
                            with the "essence of joy."</li>
                        <li><b>The Offering: </b>Use the bowl to hold fresh flower petals or floating candles as a daily
                            gesture of welcome.</li>
                    </ul>
                </div> --}}
            </div>
        </div>
    </div>
</section>
@endif

<section class="mt_80 mb_120">
    <div class="container">
        <div class="section_header">
            <p class="sub_head mb-0">
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M2.02656e-05 2.66669C2.02656e-05 4.13945 1.19393 5.33335 2.66669 5.33335C4.13945 5.33335 5.33335 4.13945 5.33335 2.66669C5.33335 1.19393 4.13945 2.02656e-05 2.66669 2.02656e-05C1.19393 2.02656e-05 2.02656e-05 1.19393 2.02656e-05 2.66669ZM2.66669 2.66669V3.16669H62.6667V2.66669V2.16669H2.66669V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
                <span>Pairs</span>
                <span><svg width="63" height="6" viewBox="0 0 63 6" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M57.3333 2.66669C57.3333 4.13945 58.5272 5.33335 60 5.33335C61.4728 5.33335 62.6667 4.13945 62.6667 2.66669C62.6667 1.19393 61.4728 2.02656e-05 60 2.02656e-05C58.5272 2.02656e-05 57.3333 1.19393 57.3333 2.66669ZM0 2.66669V3.16669H60V2.66669V2.16669H0V2.66669Z"
                            fill="#B58A46" />
                    </svg>
                </span>
            </p>
            <h2 class="title_60">Beautifully With</h2>
        </div>
        <div class="row gy-4 gy-md-0">
            @if(isset($similarProduct) && is_countable($similarProduct) && count($similarProduct) > 0)
            @foreach($similarProduct as $key => $val)
            <div class="col-md-4">
                <a class="him_prod" href="{{ route('front.product.details', $val->product_url) }}">
                    <div class="him_prod_top mb-2 mb-md-4">
                        @php
                            $imagePath = public_path('images/admin/product_list/' . $val->list_page_img);
                        @endphp
                        @if(isset($val->list_page_img) && $val->list_page_img != '' && file_exists($imagePath))
                            <img class="img-fluid img_1"
                            src="{{ isset($val->list_page_img) ? asset('public/images/admin/product_list/'.$val->list_page_img) : '' }}"
                            alt="{{ $val->product_name ?? 'Product Image' }}">
                        @else
                            <img class="img-fluid" src="{{asset('public/noimg.jpg')}}" alt="no image found">
                        @endif
                    </div>
                    <div>
                        <div>
                            <h3 class="sub_head">{{ $val->product_name ?? '' }}</h3>
                        </div>
                        <p class="fw-semibold text-dark mb-2">AED {{ number_format((float) preg_replace('/[^0-9.]/', '', $val->product_price), 0) }}</p>
                        <p class="mb-3">{!! $val->short_description ?? '' !!}</p>
                        <span class="com_btn text-nowrap d-inline-block">EXPLORE MORE</span>
                    </div>
                </a>
            </div>
            @endforeach
            @endif
            {{-- <div class="col-md-4">
                <a class="him_prod" href="javascript:void(0)">
                    <div class="him_prod_top mb-2 mb-md-4">
                        <img class="img-fluid img_1" src="{{ asset('public/images/front/desire2.webp')}}"
            alt="him_prod">
        </div>

        <div>
            <div>
                <h3 class="sub_head">The Pearl Diver’s Ledger</h3>
                <p class="mb-0">A sanctuary for deep thinking.</p>
            </div>
        </div>
        </a>
    </div>
    <div class="col-md-4">
        <a class="him_prod" href="javascript:void(0)">
            <div class="him_prod_top mb-2 mb-md-4">
                <img class="img-fluid img_1" src="{{ asset('public/images/front/desire3.webp')}}" alt="him_prod">
            </div>

            <div>
                <div>
                    <h3 class="sub_head">The Pearl Diver’s Ledger</h3>
                    <p class="mb-0">A sanctuary for deep thinking.</p>
                </div>
            </div>
        </a>
    </div> --}}
    </div>

    </div>
</section>

<div class="modal fade audio_modal" id="productInquiry" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="productInquiryLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-body">
                <div class="audio-card d-grid">
                    <div class="modal-header px-0">
                        <h5 class="modal-title" id="productInquiryLabel">Product Inquiry</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" id="productInquiryForm" action="{{ route('front.store.product.inquiry') }}">
                        @csrf
                        <input type="hidden" value="" name="inquiry_for">
                        <div class="mb-3">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" placeholder="Enter Name"
                                oninput="this.value = this.value.replace(/[^a-zA-Z\s]/g, '').replace(/\s+/g, ' ').trimStart();"
                                class="form-control @error('name') is-invalid @enderror">

                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <label class="form-label">Inquiry For Product</label>
                        <input type="text" class="form-control mb-3" value="{{ $product->product_name ?? '' }}"
                            disabled>
                        <input type="hidden" name="product_id" value="{{ $product->id ?? '' }}">
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" placeholder="Enter Your Email Address"
                                value="{{ old('email') }}" class="form-control @error('email') is-invalid @enderror">

                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Contact Number</label>
                            <input type="text" name="contact_no" placeholder="Enter your Whatsapp Phone Number"
                                value="{{ old('contact_no') }}"
                                oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 15);"
                                class="form-control @error('contact_no') is-invalid @enderror">

                            @error('contact_no')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Message</label>
                            <textarea name="message" rows="4" placeholder="Enter Message"
                                class="form-control @error('message') is-invalid @enderror">{{ old('message') }}</textarea>
                            @error('message')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="com_btn" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="com_btn">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@push('script')
<script src="{{ asset('public/js/front/cart.js') }} "></script>

<script>
var formSubmitted = false;

$(document).ready(function() {
    $("#productInquiryForm").validate({
        rules: {
            name: {
                required: true,
                minlength: 2,
                maxlength: 50,
                lettersonly: true
            },
            email: {
                required: true,
                email: true,
                noSpamEmail: true,
                //uniqueEmail: true
                uniqueEmail: "product_inquiries"
            },
            contact_no: {
                required: true,
                validPhone: true,
                number:true,
            },
            message: {
                maxlength: 300
            },
        },
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Name must be at least 2 characters",
                maxlength: "Name cannot be longer than 50 characters",
                lettersonly: "Only letters and spaces are allowed"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address",
                noSpamEmail: "This email address is not allowed",
            },
            contact_no: {
                required: "Please enter your Contact number"
            },
            comment: {
                maxlength: "Message cannot be longer than 300 characters"
            },
        },
        errorElement: 'div',
        errorPlacement: function(error, element) {
            // error.addClass('invalid-feedback');
            // if (element.attr("name") === "g-recaptcha-response") {
            //     error.insertAfter(".g-recaptcha"); // show error below CAPTCHA
            // } else {
                error.insertAfter(element);
            //}
        },
        highlight: function(element) {
            $(element).addClass('is-invalid').removeClass('is-valid');
        },
        unhighlight: function(element) {
            $(element).addClass('is-valid').removeClass('is-invalid');
        },
        submitHandler: function(form) {
            if (!formSubmitted) {
                formSubmitted = true;
                const btn = $(form).find('button[type="submit"]');
                if (btn.length) {
                    btn.prop('disabled', true).text('Submitting...');
                }
                form.submit();
            }
        }
    });
});
</script>
@endpush

@include('layouts.frontfooter')
