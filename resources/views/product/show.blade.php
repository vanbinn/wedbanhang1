@include('layouts.head')
@section('title', 'Show')
<body>	
@include('layouts.header') 
<main>
	<div class="inner-header">
		<div class="container">
			<div class="pull-left">
				<h6 class="inner-title">Product</h6>
			</div>
			<div class="pull-right">
				<div class="beta-breadcrumb font-large">
					<a href="index.html">Home</a> / <span>Product</span>
				</div>
			</div>
			<div class="clearfix"></div>
		</div>
	</div>

	<div class="container">
		<div id="content">
			<div class="row">
				<div class="col-sm-9">

					<div class="row">
						<div class="col-sm-4">
							<img src="{{ asset('source/image/product/' . $product->image) }}" alt="">
						</div>
						<div class="col-sm-8">
							<div class="single-item-body">
								<p class="single-item-title">{{$product->name}} </p>
								<p class="single-item-price">
									<span>{{$product->promotion_price}}đ</span>
								</p>
							</div>

							<div class="clearfix"></div>
							<div class="space20">&nbsp;</div>

							<div class="single-item-desc">
								<p>{{$product->description}}</p>
							</div>
							<div class="space20">&nbsp;</div>

							<p>Options:</p>
							<div class="single-item-options">
								<select class="wc-select" name="size">
									<option>Size</option>
									<option value="XS">XS</option>
									<option value="S">S</option>
									<option value="M">M</option>
									<option value="L">L</option>
									<option value="XL">XL</option>
								</select>
								<select class="wc-select" name="color">
									<option>Color</option>
									<option value="Red">Red</option>
									<option value="Green">Green</option>
									<option value="Yellow">Yellow</option>
									<option value="Black">Black</option>
									<option value="White">White</option>
								</select>
								<select class="wc-select" name="color">
									<option>Qty</option>
									<option value="1">1</option>
									<option value="2">2</option>
									<option value="3">3</option>
									<option value="4">4</option>
									<option value="5">5</option>
								</select>
								@if(isset($product))
								<form action="{{ route('add-to-cart', $product->id) }}" method="POST">
									@csrf
									<button type="submit" class="add-to-cart"><i class="fa fa-shopping-cart"></i></button>
								</form>
								@endif

								<div class="clearfix">							
								</div>
							</div>
						</div>
					</div>

					<div class="space40">&nbsp;</div>
					<div class="woocommerce-tabs">
						<ul class="tabs">
							<li><a href="#tab-description">Description</a></li>
							<li><a href="#tab-reviews">Reviews (0)</a></li>
						</ul>

						<div class="panel" id="tab-description">
							<p>{{$product->description}}</p>
							<p>Consectetur, adipisci velit, sed quia non numquam eius modi tempora incidunt ut labore et dolore magnam aliquam quaerat voluptatem. Ut enim ad minima veniam, quis nostrum exercitationem ullam corporis suscipit laboriosam, nisi ut aliquid ex ea commodi consequaturuis autem vel eum iure reprehenderit qui in ea voluptate velit es quam nihil molestiae consequr, vel illum qui dolorem eum fugiat quo voluptas nulla pariatur? </p>
						</div>
						<div class="panel" id="tab-reviews">
							<p>No Reviews</p>
						</div>
					</div>
					<div class="space50">&nbsp;</div>
						<div class="beta-products-list">
							<h4>Related Products</h4>
							@isset($products)
							<div class="row">
								@php
								$randomProducts = $products->shuffle()->take(3);
								@endphp
								@foreach($randomProducts as $product)
								<div class="col-sm-4">
									<div class="single-item">
										<div class="single-item-header">
											<a href="{{ route('product.show', $product->id) }}"><img width="260" height="260" src="{{ asset('source/image/product/' . $product->image) }}" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{ $product->name }}</p>
											<p class="single-item-price">
												@if($product->promotion_price != 0)
												<span class="flash-del">{{ number_format($product->unit_price, 0, ".", ",") }}<span class="woocommerce-Price-currencySymbol">&#8363;</span></span>
												<span class="flash-sale" style="font-weight:bold">
													{{ number_format($product->promotion_price, 0, ".", ",") }}<span class="woocommerce-Price-currencySymbol">&#8363;</span>
												</span>
												@else
												<span style="font-weight:bold">
													{{ number_format($product->unit_price, 0, ".", ",") }}<span class="woocommerce-Price-currencySymbol">&#8363;</span>
												</span>
												@endif
											</p>
										</div>
									</div>
								</div>
								@endforeach
							</div>
							@endisset
						</div> <!-- .beta-products-list -->					
						</div>
				<div class="col-sm-3 aside">
					<div class="widget">
						<h3 class="widget-title">Best Sellers</h3>
						@isset($products)
						<div class="widget-body">
							@php
							$randomProducts = $products->shuffle()->take(3);
							@endphp
							@foreach($randomProducts as $product)
							<div class="beta-sales beta-lists">
								<div class="media beta-sales-item">
									<a class="pull-left" href="{{ route('product.show', $product->id) }}"><img width="260" height="260" src="{{ asset('source/image/product/' . $product->image) }}" alt=""></a>
									<div class="media-body">
									{{ $product->name }}
										<span class="beta-sales-price">{{ number_format($product->unit_price, 0, ".", ",") }}đ</span>
									</div>
								</div>
							</div>
								@endforeach
							</div>
							@endisset
							</div> <!-- best sellers widget -->
								<div class="widget">
									<h3 class="widget-title">New Products</h3>
									@isset($new_products)
									<div class="widget-body">
										@php
										$randomProducts = $new_products->shuffle()->take(3);
										@endphp
										@foreach($randomProducts as $new_product)
										<div class="beta-sales beta-lists">
											<div class="media beta-sales-item">
												<a class="pull-left" href="{{ route('product.show', $new_product->id) }}"><img width="260" height="260" src="{{ asset('source/image/product/' . $new_product->image) }}" alt=""></a>
												<div class="media-body">
													{{ $new_product->name }}
													<span class="beta-sales-price">{{ number_format($new_product->unit_price, 0, ".", ",") }}đ</span>
												</div>
											</div>
										</div>
										@endforeach
									</div>
									@endisset
								</div>

					</div> <!-- best sellers widget -->
				</div>
			</div>
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
