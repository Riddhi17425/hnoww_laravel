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
			<div class="row">
				<div class="col-12">
					<!-- Shopping Summery -->
					<table class="table shopping-summery">
						<thead>
							<tr class="main-hading">
								<th>PRODUCT</th>
								<th>NAME</th>
								<th class="text-center">UNIT PRICE</th>
								<th class="text-center">QUANTITY</th>
								<th class="text-center">TOTAL</th>
								<th class="text-center"><i class="ti-trash remove-icon"></i></th>
							</tr>
						</thead>
						<tbody id="cart_item_list">
							<form action="" method="POST" id="cart-update-form">
								@csrf
								@if(isset($cartData) && count($cartData) > 0 && is_countable($cartData) > 0)
									@foreach($cartData as $key=>$cart)
										<tr>
											<td class="image" data-title="No">
											</td>
											<td class="product-des" data-title="Description">
												<p class="product-name"><a href="" target="_blank">{{ $cart->product->product_name ?? '' }}</a></p>
											</td>
											<td class="price" data-title="Price"><span>{{ $cart->product->product_price ?? '' }}</span></td>
											<td class="qty" data-title="Qty"><!-- Input Order -->
												<div class="input-group">
													<div class="button minus"> 
														<button type="button" class="btn btn-primary btn-number" data-type="minus" data-field="quant[{{$key}}]" min="1">
															<i class="ti-minus"></i>
														</button>
													</div>

													<input type="text" name="quant[{{$key}}]" class="input-number"  data-min="1" data-max="100" value="{{$cart->quantity}}" readonly>
													<input type="hidden" name="qty_id[]" value="{{$cart->id}}">

													<div class="button plus">
														<button type="button" class="btn btn-primary btn-number" data-type="plus" data-field="quant[{{$key}}]">
															<i class="ti-plus"></i>
														</button>
													</div>
												</div>
												<!--/ End Input Order -->
											</td>
											<td class="total-amount cart_single_price" data-title="Total"><span class="money"> AED 100</span></td>

											<td class="action" data-title="Remove"><a href=""><i class="ti-trash remove-icon"></i></a></td>
										</tr>
									@endforeach
									<track>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
										<td></td>
									</track>
								@else
										<tr>
											<td class="text-center">
												There are no any carts available. <a href="" style="color:blue;">Continue shopping</a>

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
			<div class="row">
				<div class="col-12">
					<!-- Total Amount -->
					<div class="total-amount">
						<div class="row">
							<div class="col-lg-4 col-md-7 col-12">
								<div class="right">
									<ul>
										<li class="order_subtotal" data-price="">Cart Subtotal<span> AED </span></li>
										<li class="last" id="order_total_price">You Pay<span> AED </span></li>
									</ul>
									<div class="button5">
										<a href="" class="btn">Checkout</a>
										<a href="" class="btn">Continue shopping</a>
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