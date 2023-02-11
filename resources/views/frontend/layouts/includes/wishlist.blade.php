@if ($wishlists->count() > 0)
    <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i> <span
            class="total-count">{{ $wishlists->count() }}</span></a>
    {{-- <!-- Shopping Item --> --}}
    <div class="shopping-item">
        <div class="dropdown-cart-header">
            <span>{{ $wishlists->count() }} Items</span>
            <a href="{{ route('frontend.cart.index') }}">View Wishlist</a>
        </div>
        <ul class="shopping-list">
            @foreach ($wishlists as $wishlist)
                <li>
                    <a href="#" onClick="wishlistDelete(event, '{{ $wishlist->id }}')" class="remove"
                        title="Remove this item"><i class="fa fa-remove"></i></a>
                    <a class="cart-img" href="#"><img
                            src="{{ imagePath('product', $wishlist->product->file->file) }}" alt="#"></a>
                    <h4><a href="#">{{ $wishlist->product->name }}</a></h4>
                    <p class="quantity"><span class="amount">&#2547; {{ $wishlist->product->price }}</span></p>
                </li>
            @endforeach
        </ul>
        <div class="bottom">
            <div class="total">
                <span>Total</span>
                <span class="total-amount">&#2547; {{ $wishlist->product->sum('price') }}</span>
            </div>
            {{-- <a href="checkout.html" class="btn animate">Checkout</a> --}}
        </div>
    </div>
    {{-- <!--/ End Shopping Item --> --}}
@else
    <a href="#" class="single-icon"><i class="fa fa-heart-o" aria-hidden="true"></i> <span
            class="total-count">0</span></a>
@endif
