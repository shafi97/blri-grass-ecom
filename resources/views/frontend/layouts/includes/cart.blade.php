@if ($datum->count() > 0)
    <span class="mini-cart-icon">
        <i class="icon-shopping-cart"></i>
        <sup>{{ $datum->count() }}</sup>
    </span>
    @php $totalPrice = 0; @endphp
    @foreach ($datum as $data)
        @php $totalPrice += $data->product->price - ($data->product->price * $data->product->discount) / 100; @endphp
    @endforeach
    <h6><span>Your Cart</span> <span class="ltn__secondary-color">&#2547; {{ number_format($totalPrice, 2) }}</span></h6>
@else
    <span class="mini-cart-icon">
        <i class="icon-shopping-cart"></i>
        <sup>0</sup>
    </span>
    <h6><span>Your Cart</span> <span class="ltn__secondary-color">&#2547; 0</span></h6>
@endif
