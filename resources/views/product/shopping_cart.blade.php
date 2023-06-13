@include('layouts.head')
@section('title', 'Singup')
<body>	
@include('layouts.header') 
<main>
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Shopping Cart</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Shopping Cart</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>
	
	<div class="container">
    <div id="content">
        <div class="table-responsive">
            <!-- Shop Products Table -->
            <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                <thead>
                    <tr>
                        <th class="product-name">Product</th>
                        <th class="product-price">Price</th>
                        <th class="product-status">Status</th>
                        <th class="product-quantity">Qty.</th>
                        <th class="product-subtotal">Total</th>
                        <th class="product-remove">Remove</th>
                    </tr>
                </thead>
                <tbody>
                    @if (Session::has('cart') && count(Session::get('cart')->items) > 0)
                        <?php $cart = Session::get('cart'); ?>
                        @foreach ($cart->items as $item)
                            <tr class="cart_item">
                                <td class="product-name">
                                    <div class="media">
									<img class="pull-left" src="{{ asset('source/image/product/' . $item['item']->image) }}" alt="" width="100">
                                        <div class="media-body">
                                            <p class="font-large table-title">{{ $item['item']->name }}</p>
                                            <p class="table-option">Color: {{ $item['item']->color }}</p>
                                            <p class="table-option">Size: {{ $item['item']->size }}</p>

                                            <a class="table-edit" href="#">Edit</a>
                                        </div>
                                    </div>
                                </td>
                                <td class="product-price">
								@if (isset($item['qty']))
                                    <span class="amount">
                                    @if ($item['item']->promotion_price != 0)
                                    <span>{{ number_format($item['item']->promotion_price, 0, ',', '.') }} đ</span>
                                @else
                                    <span>{{ number_format($item['item']->unit_price, 0, ',', '.') }} đ</span>
                                @endif
								</span>
								@endif

                                </td>
								
                                <td class="product-status">
                                    In Stock
                                </td>
                                <td class="product-quantity">
                                    <select name="product-qty[]" id="product-qty">
                                        <option value="1" {{ $item['qty'] == 1 ? 'selected' : '' }}>1</option>
                                        <option value="2" {{ $item['qty'] == 2 ? 'selected' : '' }}>2</option>
                                        <option value="3" {{ $item['qty'] == 3 ? 'selected' : '' }}>3</option>
                                        <option value="4" {{ $item['qty'] == 4 ? 'selected' : '' }}>4</option>
                                        <option value="5" {{ $item['qty'] == 5 ? 'selected' : '' }}>5</option>
                                    </select>
                                </td>

								<td class="product-subtotal">
                                <span class="amount">
                                    @if ($item['item']->promotion_price != 0)
                                        {{ number_format($item['qty'] * $item['item']->promotion_price, 0, ',', '.') }} đ
                                    @else
                                        {{ number_format($item['qty'] * $item['item']->unit_price, 0, ',', '.') }} đ
                                    @endif
                                </span>
								</td>
								<td>
								<form action="{{ route('delete-item', $item['item']->id) }}" method="POST">
									@csrf
									@method('DELETE')
									<button type="submit" class="btn btn-sm btn-danger">
										<span class="fa fa-trash-o"></span>
									</button>
								</form>
                                 </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="6">
                                <p>Giỏ hàng của bạn đang trống.</p>
                            </td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                    <td colspan="6" class="actions">
                <div class="coupon">
                    <label for="coupon_code">Coupon</label>
                    <input type="text" name="coupon_code" value="" placeholder="Coupon code">
                    <button type="submit" class="beta-btn primary" name="apply_coupon">Apply Coupon <i class="fa fa-chevron-right"></i></button>
                </div>
     <button type="submit" class="beta-btn primary" name="update_cart">Update Cart<i class="fa fa-chevron-right"></i></button>
</form>



 
 
                <a href="/checkout" class="beta-btn primary" name="proceed">Checkout<i class="fa fa-chevron-right"></i></a> 
            </td>
            </tr>

                </tfoot>
            </table>
            <!-- End of Shop Table Products -->
        </div>
        <!-- Cart Collaterals -->
        <div class="cart-collaterals">
            <div class="cart-totals pull-right">
			<div class="cart-totals-row">
				<span>Cart Subtotal:</span>
				@if ($cart && count($cart->items) > 0)
					<span>{{ number_format($cart->totalPrice, 0, ',', '.') }} đ</span>
				@else
					<span>0 đ</span> <!-- Hoặc giá trị mặc định khác bạn mong muốn -->
				@endif
			</div>
			<div class="cart-totals-row">
				<span>Shipping:</span>
				<span>Free Shipping</span>
			</div>
			<div class="cart-totals-row">
				<span>Order Total:</span>
				@if ($cart && count($cart->items) > 0)
					<span>{{ number_format($cart->totalPrice, 0, ',', '.') }} đ</span>
				@else
					<span>0 đ</span> <!-- Hoặc giá trị mặc định khác bạn mong muốn -->
				@endif
			</div>
</div>
            <div class="clearfix"></div>
        </div>
    </div>
</div>

			</div>
			<!-- End of Cart Collaterals -->
			<div class="clearfix"></div>

		</div> <!-- #content -->
	</div> <!-- .container -->

	</main>
@include('layouts.footer') 
<script>
	 jQuery(document).ready(function($) {
                'use strict';
				
// color box

//color
      jQuery('#style-selector').animate({
      left: '-213px'
    });

    jQuery('#style-selector a.close').click(function(e){
      e.preventDefault();
      var div = jQuery('#style-selector');
      if (div.css('left') === '-213px') {
        jQuery('#style-selector').animate({
          left: '0'
        });
        jQuery(this).removeClass('icon-angle-left');
        jQuery(this).addClass('icon-angle-right');
      } else {
        jQuery('#style-selector').animate({
          left: '-213px'
        });
        jQuery(this).removeClass('icon-angle-right');
        jQuery(this).addClass('icon-angle-left');
      }
    });
				});
	</script>
</body>
</html>