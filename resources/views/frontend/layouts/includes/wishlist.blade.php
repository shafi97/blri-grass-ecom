@if ($wishlists->count() > 0)
    @foreach ($wishlists as $wishlist)
        <tr>
            <td class="text-center">
                <a href="javascript:;" onclick="wishlistDelete(event, '{{ $wishlist->id }}')">
                    <i class="fa-solid fa-trash text-danger"></i>
                </a>
            </td>
            <td class="cart-product-image">
                <a href="{{ route('product.show', $wishlist->product_id) }}"><img src="{{ imagePath('product', $wishlist->product->file->file) }}"
                        alt="#"></a>
            </td>
            <td class="cart-product-info">
                <h4><a href="{{ route('product.show', $wishlist->product_id) }}">{{ $wishlist->product->name }}</a>
                </h4>
            </td>
            <td class="cart-product-price">
                &#2547;
                {{ number_format($wishlist->product->price - ($wishlist->product->price * $wishlist->product->discount) / 100) }}
            </td>
            <td class="cart-product-stock">In Stock</td>
            <td class="cart-product-add-cart text-center">
                @auth
                    <a class="submit-button-1" href="#" title="Add to Cart"
                        onclick="wishlistAddToCart(event,'{{ $wishlist->id }}')">Add to Cart</a>
                @endauth
                @guest
                    <a href="javascript:;" data-toggle="modal" data-target="#loginModal">
                        <i class="fas fa-shopping-cart"></i>
                    </a>
                @endguest

            </td>
        </tr>
    @endforeach
@endif
