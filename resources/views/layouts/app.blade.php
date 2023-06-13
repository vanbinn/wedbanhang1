<!doctype html>
<html lang="en">
	<!-- index -->
<head>
	<title>@yield('title')</title>
	
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Laravel </title>
		<link href='http://fonts.googleapis.com/css?family=Dosis:300,400' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="http://netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css">
		<link rel="stylesheet" href="/source/assets/dest/css/font-awesome.min.css">
		<link rel="stylesheet" href="/source/assets/dest/vendors/colorbox/example3/colorbox.css">
		<link rel="stylesheet" href="/source/assets/dest/rs-plugin/css/settings.css">
		<link rel="stylesheet" href="/source/assets/dest/rs-plugin/css/responsive.css">
		<link rel="stylesheet" title="style" href="/source/assets/dest/css/style.css">
		<link rel="stylesheet" href="/source/assets/dest/css/animate.css">
		<link rel="stylesheet" title="style" href="/source/assets/dest/css/huong-style.css">
</head>
<body>
	@include('layouts.header')
	<div class="rev-slider">
    <div class="fullwidthbanner-container">
        <div class="fullwidthbanner">
            <div class="bannercontainer">
                <div class="banner">
				<ul>
    <!-- THE FIRST SLIDE -->
    @foreach($slides as $slide)
        <li data-transition="boxfade" data-slotamount="20" class="active-revslide" style="width: 100%; height: 100%; overflow: hidden; z-index: 18; visibility: hidden; opacity: 0;">
            <div class="slotholder" style="width:100%;height:100%;" data-duration="undefined" data-zoomstart="undefined" data-zoomend="undefined" data-rotationstart="undefined" data-rotationend="undefined" data-ease="undefined" data-bgpositionend="undefined" data-bgposition="undefined" data-kenburns="undefined" data-easeme="undefined" data-bgfit="undefined" data-bgfitend="undefined" data-owidth="undefined" data-oheight="undefined">
                <div class="tp-bgimg defaultimg" data-lazyload="undefined" data-bgfit="cover" data-bgposition="center center" data-bgrepeat="no-repeat" data-lazydone="undefined" src="{{ asset('source/image/slide/' . $slide->image) }}" data-src="{{ asset('source/image/slide/' . $slide->image) }}" style="background-color: rgba(0, 0, 0, 0); background-repeat: no-repeat; background-image: url('{{ asset('source/image/slide/' . $slide->image) }}'); background-size: cover; background-position: center center; width: 100%; height: 100%; opacity: 1; visibility: inherit;"></div>
            </div>
        </li>
    @endforeach
</ul>
>
                </div>
            </div>

            <div class="tp-bannertimer"></div>
        </div>
    </div>
    <!--slider-->
</div>


	<main>
		@yield('content')
			@isset($products)
			<div class="container">
				<div id="content" class="space-top-none">
					<div class="main-content">
						<div class="space60">&nbsp;</div>
						<div class="row">
							<div class="col-sm-12">
								<div class="beta-products-list">
									<h4>New Products</h4>
									<div class="beta-products-details">
				<div class="clearfix"></div>
			</div>
				<div class="row">
				@foreach($new_product->where('new', true) as $new_product)
						<div class="col-sm-3">
							<div class="single-item">
								<div class="single-item-header">
								<a href="{{ route('product.show', $new_product->id) }}"><img width="260" height="260" src="{{ asset('source/image/product/' . $new_product->image) }}" alt=""></a>
								</div>
								<div class="single-item-body">
									<p class="single-item-title">{{ $new_product->name }}</p>
									<p class="single-item-price">
										@if($new_product->promotion_price!=0)
										<span class="flash-del">{{number_format($new_product->unit_price,0,".",",")}}<span class="woocommerce-Price-currencySymbol">&#8363;</span></span>
										<span class="flash-sale" style="font-weight:bold">
										{{number_format($new_product->promotion_price,0,".",",")}}<span class="woocommerce-Price-currencySymbol">&#8363;</span></span>
										@else
										<span style="font-weight:bold">
										{{number_format($new_product->unit_price,0,".",",")}}<span class="woocommerce-Price-currencySymbol">&#8363;</span></span>
										@endif
									</p>						 
								</div>
								<div class="single-item-caption">
									
									<div class="row">
										<form action="{{ route('add-to-cart', $new_product->id) }}" method="POST">
										@csrf
										<button type="submit" class="add-to-cart"><i class="fa fa-shopping-cart"></i></button>
										</form>
										<form>
										<a class="beta-btn primary" href="{{ route('product.show', $new_product->id) }}">Details <i class="fa fa-chevron-right"></i></a>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endisset


			</div>
			</div>
		
									<div class="space50">&nbsp;</div>

									<div class="beta-products-list">
										<h4>Top Products</h4>
										<div class="beta-products-details">
											<p class="pull-left">438 styles found</p>
											<div class="clearfix"></div>
										</div>
										@isset($products)
				<div class="row">
				@foreach($products as $product)
						<div class="col-sm-3">
							<div class="single-item">
								<div class="single-item-header">
								<a href="{{ route('product.show', $product->id) }}"><img width="260" height="260" src="{{ asset('source/image/product/' . $product->image) }}" alt=""></a>
								</div>
								<div class="single-item-body">
									<p class="single-item-title">{{ $product->name }}</p>
									<p class="single-item-price">
										@if($product->promotion_price!=0)
										<span class="flash-del">{{number_format($product->unit_price,0,".",",")}}<span class="woocommerce-Price-currencySymbol">&#8363;</span></span>
										<span class="flash-sale" style="font-weight:bold">
										{{number_format($product->promotion_price,0,".",",")}}<span class="woocommerce-Price-currencySymbol">&#8363;</span></span>
										@else
										<span style="font-weight:bold">
										{{number_format($product->unit_price,0,".",",")}}<span class="woocommerce-Price-currencySymbol">&#8363;</span></span>
										@endif
									</p>
									
								</div>
								<div class="single-item-caption">
									<div class="row">
								<form action="{{ route('add-to-cart', $product->id) }}" method="POST">
									@csrf
									<button type="submit" class="add-to-cart"><i class="fa fa-shopping-cart"></i></button>
								</form>


										<a class="beta-btn primary" href="{{ route('product.show', $product->id) }}">Details <i class="fa fa-chevron-right"></i></a>
										</form>
									</div>
									<div class="clearfix"></div>
								</div>
							</div>
						</div>
					@endforeach
				</div>
			@endisset
		
			</div>
			</div>


					</div> <!-- .main-content -->
				</div> <!-- #content -->
			</div> <!-- .container -->
	</main>
	@include('layouts.footer')
</body>
</html>















