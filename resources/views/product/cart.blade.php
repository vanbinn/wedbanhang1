<a href="{{ route('product.index') }}">
    <i class="fa fa-shopping-cart"></i>
    @if(isset($cart) && count($cart->items) > 0)
    <span class="cart-count">{{ count($cart->items) }}</span>
@endif    
</a>