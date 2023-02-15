<div class="ltn__modal-area ltn__add-to-cart-modal-area">
    <div class="modal fade" id="add_to_cart_modal" tabindex="-1">
        <div class="modal-dialog modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="ltn__quick-view-modal-inner">
                        <div class="modal-product-item">
                            <div class="row">
                                <div class="col-11 text-center">
                                    {{-- <div class="modal-product-img">
                                        <img src="" alt="#" id="cart_product_image">
                                    </div> --}}
                                    <div class="modal-product-info">
                                        <h5><a href="product-details.html" class="cart_product_name"></a></h5>
                                        <p class="added-cart"><i class="fa fa-check-circle"></i> Successfully
                                            added to your Cart</p>
                                        <div class="btn-wrapper">
                                            <a href="{{ route('frontend.cart.index') }}" class="theme-btn-1 btn btn-effect-1">View
                                                Cart</a>
                                            {{-- <a href="checkout.html"
                                                class="theme-btn-2 btn btn-effect-2">Checkout</a> --}}
                                        </div>
                                    </div>
                                    <!-- additional-info -->
                                    <div class="additional-info d-none">
                                        <p>We want to give you <b>10% discount</b> for your first order, <br>
                                            Use discount code at checkout</p>
                                        <div class="payment-method">
                                            <img src="img/icons/payment.png" alt="#">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
