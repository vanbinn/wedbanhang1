<header>
@yield('header')
		<div id="header">
			<div class="header-top">
				<div class="container">
					<div class="pull-left auto-width-left">
						<ul class="top-menu menu-beta l-inline">
							<li><a href=""><i class="fa fa-home"></i> 90-92 Lê Thị Riêng, Bến Thành, Quận 1</a></li>
							<li><a href=""><i class="fa fa-phone"></i> 0163 296 7751</a></li>
						</ul>
					</div>
					<div class="pull-right auto-width-right">
						<ul class="top-details menu-beta l-inline">
							<li><a href="#"><i class="fa fa-user"></i>Tài khoản</a></li>
							<li><a href="/signup">Đăng kí</a></li>
							<li><a href="/login">Đăng nhập</a></li>
						</ul>
					</div>
					<div class="clearfix"></div>
				</div> <!-- .container -->
			</div> <!-- .header-top -->
			<div class="header-body">
				<div class="container beta-relative">
					<div class="pull-left">
						<a href="index.html" id="logo"><img src="/source/assets/dest/images/logo-cake.png" width="200px" alt=""></a>
					</div>
					<div class="pull-right beta-components space-left ov">
						<div class="space10">&nbsp;</div>

						<div class="beta-comp">
							<form role="search" method="get" id="searchform" action="/">
								<input type="text" value="" name="s" id="s" placeholder="Nhập từ khóa..." />
								<button class="fa fa-search" type="submit" id="searchsubmit"></button>
							</form>
						</div>
						<div class="cart">
	<div class="beta-select">
	<i class="fa fa-shopping-cart"></i> Giỏ hàng ({{ Session::has('cart') ? count(Session::get('cart')->items) : 0 }} sản phẩm) <i class="fa fa-chevron-down"></i>
	</div>
	<div class="beta-dropdown cart-body">
		@if (Session::has('cart') && count(Session::get('cart')->items) > 0)
		<?php $cart = Session::get('cart'); ?>
		@foreach ($cart->items as $item)
	<div class="cart-item">
		<div class="media">
		<a class="pull-left" href="#">
			<img src="{{ asset('source/image/product/' . $item['item']->image) }}" alt="">
		</a>
		<div class="media-body">
			<span class="cart-item-title">{{ $item['item']->name }}</span>
			<span class="cart-item-options">Size: XS; Colar: Navy</span>
			@if (isset($item['qty']))
			<span class="cart-item-amount">
			{{ $item['qty'] }} x 
				@if ($item['item']->promotion_price != 0)
					<span>{{ number_format($item['item']->promotion_price, 0, ',', '.') }} đ</span>
				@else
					<span>{{ number_format($item['item']->unit_price, 0, ',', '.') }} đ</span>
				@endif
			</span>
				@endif


		</div>
		</div>
	</div>
	@endforeach
		<div class="cart-caption">
			<div class="cart-total text-right">Tổng tiền: <span class="cart-total-value">{{ number_format($cart->totalPrice, 0, ',', '.') }} đ</span></div>
			<div class="clearfix"></div>
			<div class="center">
			<div class="space10">&nbsp;</div>
			<form action="{{ route('product.shopping_cart') }}" method="POST">
				@csrf
				<button type="submit" class="beta-btn primary text-center">
					Giỏ hàng <i class="fa fa-chevron-right"></i>
				</button>
			</form>

 			</div>
		</div>
		@else
		<p>Giỏ hàng của bạn đang trống.</p>
		@endif
	</div>
		</div>
					<div class="clearfix"></div>
				</div> <!-- .container -->
			</div> <!-- .header-body -->
			<div class="header-bottom" style="background-color: #0277b8;">
				<div class="container">
					<a class="visible-xs beta-menu-toggle pull-right" href="#"><span class='beta-menu-toggle-text'>Menu</span> <i class="fa fa-bars"></i></a>
					<div class="visible-xs clearfix"></div>
					<nav class="main-menu">
						<ul class="l-inline ov">
							<li><a href="/products">Trang chủ</a></li>
							<li>
 							<a href="#">Sản phẩm</a>
							<ul class="sub-menu">
							@foreach($categories as $category)
								<li><a href="{{ route('product.category', $category->id) }}">{{ $category->name }}</a></li>
							@endforeach

							</ul>
							</li>



							<li><a href="/about">Giới thiệu</a></li>
							<li><a href="/contacts">Liên hệ</a></li>
						</ul>
						<div class="clearfix"></div>
					</nav>
				</div> <!-- .container -->
			</div> <!-- .header-bottom -->
		</div> <!-- #header -->
</header>
