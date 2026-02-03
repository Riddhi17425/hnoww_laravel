@include('layouts.frontheader')
<section class="hero-section_inner">
    <img class="img-fluid" src="{{asset('public/images/front/atelier-banner.png')}}" alt="him banner">

    <div class="hero_content_inner">
        <h2 class="main_head">The Cart</h2>
        <p class="para">Your Products!</p>
    </div>
</section>

<section class="mt_120">
    <div class="container">
	

	<!-- Shopping Cart -->
	<div class="shopping-cart section">
		<div class="container">
			@php $subTotal = 0; @endphp
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th>UNIT PRICE (IN AED)</th>
								<th>QUANTITY</th>
								<th>TOTAL (IN AED)</th>
								<th><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody id="cart_item_list">
							<form action="" method="POST" id="cart-update-form">
								@csrf
								@if(isset($cartData) && count($cartData) > 0 && is_countable($cartData) > 0)
									@foreach($cartData as $key=>$cart)
									@php $subTotal += ($cart->price * $cart->quantity) @endphp
										<tr id="cart-row-{{$cart->id}}" class="cart-item-row">
											<td class="image" data-title="Product Image">
												<a href="{{ route('front.product.details', $cart->product->product_url) }}"><img class="img-fluid img_1" src="{{ isset($cart->product->list_page_img) ? asset('public/images/admin/product_list/'.$cart->product->list_page_img) : '' }}" height="120" width="150" alt="{{ $cart->product->product_name ?? 'Product Image' }}"></a>
											</td>
											<td class="" data-title="Product Name">
												<p class="product-name"><a href="" target="_blank">{{ $cart->product->product_name ?? '' }}</a></p>
											</td>
											<td class="price" data-title="Price"><span class="unit-price" data-price="{{ $cart->price }}">{{ $cart->price ?? '' }}</span></td>
											<td>
												<div class="increment_decrement_area">
													<div class="increment_decrement" data-product-id="{{ $cart->product_id }}" data-stock="{{ $cart->product->product_stock }}">
														<button class="dec_btn" type="button">−</button>
														<span class="span_value">{{$cart->quantity ?? 1}}</span>
														<input type="hidden" class="qty_input" id="product-qty" value="{{$cart->quantity ?? 1}}">
														<button class="inc_btn" type="button">+</button>
													</div>
												</div>
											</td>
											<td class="total-amount cart_single_price" data-title="Total"><span class="row-total"> {{ $cart->price ? ($cart->price * $cart->quantity) : '' }}</span></td>
											<td><a href="javascript:void(0);" class="btn btn-danger delete-cart-item"  data-id="{{ $cart->id }}"><i class="fa fa-trash"></i></a></td>
										</tr>
									@endforeach
								@else
										<tr>
											<td class="text-center">
												There are no any carts available. <a href="{{ route('front.home') }}" class="com_btn">Continue shopping</a>
											</td>
										</tr>
								@endif

							</form>
						</tbody>
					</table>
					<!--/ End Shopping Summery -->
				</div>
			</div>
			@if($cartData->count() > 0)
			<div class="row" id="calculation-section">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
										<li class="order_subtotal" data-price="">Cart Subtotal <span id="cart-subtotal">{{ $subTotal ?? 0 }} AED </span></li>
										<li class="last" id="order_total_price">You Pay <span id="you-pay">{{ $subTotal ?? 0 }} AED </span></li>
									</ul>
									<div class="button5">
										<a href="" class="com_btn">Checkout</a>
										<a href="{{ route('front.home') }}" class="com_btn">Continue shopping</a>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!--/ End Total Amount -->
				</div>
			</div>
            @endif
		</div>
	</div>
	<!--/ End Shopping Cart -->
    </div>
</section>

@push('script')
<script src="{{ asset('public/js/front/cart.js') }} "></script>
	<script>
		$(document).on('change', '.input-number', function () {
			clearTimeout(window.cartTimer);
			window.cartTimer = setTimeout(function () {
				$('#cart-update-form').submit();
			}, 300); // debounce
		});

	</script>

@endpush
@include('layouts.frontfooter')