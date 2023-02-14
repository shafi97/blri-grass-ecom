<div class="mini-cart-product-area ltn__scrollbar">
    @php
        $totalPrice = 0;
    @endphp
    @foreach ($datum as $data)
        <div class="mini-cart-item clearfix">
            <div class="mini-cart-img">
                <a href="#"><img src="{{ imagePath('product', $data->product->file->file) }}" alt="Image"></a>
                <span class="mini-cart-item-delete" onClick="cartDelete(event, '{{ $data->id }}')" ><i class="icon-cancel"></i></span>
            </div>
            <div class="mini-cart-info">
                <h6><a href="#">{{ $data->product->name }}</a></h6>
                <span class="mini-cart-quantity">&#2547; {{ number_format($data->product->price - ($data->product->price * $data->product->discount) / 100) }}</span>
            </div>
        </div>
        @php
            $totalPrice += $data->product->price - ($data->product->price * $data->product->discount) / 100;
        @endphp
    @endforeach
</div>
<div class="mini-cart-footer">
    <div class="mini-cart-sub-total">
        <h5>Subtotal: <span>&#2547; {{ number_format($totalPrice, 2)  }}</span></h5>
    </div>
    <div class="btn-wrapper">
        <a href="{{ route('frontend.cart.index') }}" class="theme-btn-1 btn btn-effect-1">View Cart</a>
        <a href="cart.html" class="theme-btn-2 btn btn-effect-2">Checkout</a>
    </div>
</div>
