@if ($datum->count() > 0)
    <span class="mini-cart-icon">
        <i class="icon-shopping-cart"></i>
        <sup>{{ $datum->count() }}</sup>
    </span>
    <h6><span>Your Cart</span> <span class="ltn__secondary-color">&#2547; 0</span></h6>
@else
    <span class="mini-cart-icon">
        <i class="icon-shopping-cart"></i>
        <sup>0</sup>
    </span>
    <h6><span>Your Cart</span> <span class="ltn__secondary-color">&#2547; 0</span></h6>
@endif
