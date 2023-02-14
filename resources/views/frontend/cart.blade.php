@extends('frontend.layouts.app')
@section('content')
    <!-- Shopping Cart -->
    <div class="shopping-cart section">
        <div class="container">
            <form action="{{ route('frontend.shipping.multipleStore') }}" method="post">
                @csrf
                <div class="row">
                    <div class="col-12">
                        <table id="myTable" class="table table-bordered shopping-summery">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th class="text-right"><span id="amount" class="amount">Amount</span> </th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($carts as $cart)
                                    <input type="hidden" name="product_id[]" value="{{ $cart->product_id }}">
                                    <tr>
                                        <td>
                                            <img src="{{ imagePath('product', $cart->product->file->file) }}">
                                        </td>
                                        <td>
                                            <p>{{ $cart->product->name }}</p>
                                        </td>
                                        <td>
                                            <div class="button-container d-flex">
                                                <button class="cart-qty-minus p-2" style="height: 40px" type="button"
                                                    value="-" onclick="decrementStore(event, '{{ $cart->id }}')">
                                                    <i class="fa-solid fa-minus"></i>
                                                </button>
                                                <input type="text" name="quantity" min="1"
                                                    class="qty form-control" value="{{ $cart->quantity }}" />
                                                <button class="cart-qty-plus p-2" style="height: 40px" type="button"
                                                    value="+" onclick="incrementStore(event, '{{ $cart->id }}')">
                                                    <i class="fa-solid fa-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <input type="text" value="{{ $cart->product->price }}"
                                                class="price form-control" disabled>
                                        </td>
                                        <td align="right">
                                            &#2547; <span id="amount"
                                                class="amount">{{ $cart->quantity * $cart->product->price }}</span>
                                        </td>
                                        <td class="action text-center" data-title="Remove">
                                            <a href="{{ route('frontend.cart.delete', $cart->id) }}">
                                                <i class="fa-solid fa-trash text-danger"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach

                            </tbody>
                            {{-- <tfoot>
                            <tr>
                                <td colspan="4"></td>
                                <td align="right"><strong>TOTAL = &#2547; <span id="total" class="total">0</span></strong>
                                </td>
                            </tr>
                        </tfoot> --}}
                        </table>
                    </div>
                </div>
                <!--/ End Shopping Summery -->
                <div class="row">
                    <div class="col-12">
                        <!-- Total Amount -->
                        <div class="total-amount">
                            <div class="row">
                                <div class="col-lg-8 col-md-5 col-12">
                                    {{-- <div class="left">
                                    <div class="coupon">
                                        <form action="#" target="_blank">
                                            <input name="Coupon" placeholder="Enter Your Coupon">
                                            <button class="btn">Apply</button>
                                        </form>
                                    </div>
                                    <div class="checkbox">
                                        <label class="checkbox-inline" for="2"><input name="news" id="2"
                                                type="checkbox"> Shipping (+10$)</label>
                                    </div>
                                </div> --}}
                                </div>
                                <div class="col-lg-4 col-md-7 col-12">
                                    <div class="right">
                                        <ul>
                                            <li>Cart Subtotal  <span id="total" class="total">0</span></li>
                                            <li>Shipping<span> 60</span></li>
                                            {{-- <li>You Save<span>$20.00</span></li> --}}
                                            <li class="last">You Pay<span class="totalPay"></span></li>
                                        </ul>
                                        <div class="button5">
                                            <button type="submit" class="btn btn-success">Checkout</button>
                                            <a href="{{ url()->previous() }}" class="btn btn-primary">Continue shopping</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--/ End Total Amount -->
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--/ End Shopping Cart -->

    @push('custom_scripts')
        <script>
            // -----------------for-Shopping-cart-------------
            $(document).ready(function() {
                update_amounts();
                $('.qty, .price').on('keyup keypress blur change', function(e) {
                    update_amounts();
                });
            });

            function update_amounts() {
                var sum = 0.0;
                $('#myTable > tbody  > tr').each(function() {
                    var qty = $(this).find('.qty').val();
                    var price = $(this).find('.price').val();
                    var amount = (qty * price)
                    sum += amount;
                    $(this).find('.amount').text('' + amount);
                });
                $('.total').text(sum);
                $('.totalPay').text(sum + 60);
            }

            //----------------for quantity-increment-or-decrement-------
            var incrementQty;
            var decrementQty;
            var plusBtn = $(".cart-qty-plus");
            var minusBtn = $(".cart-qty-minus");
            var incrementQty = plusBtn.click(function() {
                var $n = $(this)
                    .parent(".button-container")
                    .find(".qty");
                $n.val(Number($n.val()) + 1);
                update_amounts();
            });

            var decrementQty = minusBtn.click(function() {
                var $n = $(this)
                    .parent(".button-container")
                    .find(".qty");
                var QtyVal = Number($n.val());
                if (QtyVal > 1) {
                    $n.val(QtyVal - 1);
                }
                update_amounts();
            });

            function incrementStore(e, cart_id) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('frontend.cart.incrementStore') }}',
                    type: 'POST',
                    data: {
                        'cart_id': cart_id,
                    },
                    success: res => {
                        cartShow()
                        toast('success', res.message)
                    },
                    error: err => {}
                });
            }

            function decrementStore(e, cart_id) {
                e.preventDefault();
                $.ajax({
                    url: '{{ route('frontend.cart.decrementStore') }}',
                    type: 'POST',
                    data: {
                        'cart_id': cart_id,
                    },
                    success: res => {
                        cartShow()
                        toast('success', res.message)
                    },
                    error: err => {}
                });
            }
        </script>
    @endpush
@endsection
