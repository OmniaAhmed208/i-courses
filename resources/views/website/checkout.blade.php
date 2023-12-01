@extends('layouts.app')
@section('title', setting('website_name') . " Checkout")
@section('content')
    <!-- ================================
    START BREADCRUMB AREA
================================= -->
    <section class="breadcrumb-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-content">
                        <div class="section-heading">
                            <h2 class="section__title">Checkout</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">home</a></li>
                            <li>Checkout</li>
                        </ul>
                    </div><!-- end breadcrumb-content -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end breadcrumb-area -->
    <!-- ================================
        END BREADCRUMB AREA
    ================================= -->

    <!-- ================================
        START CHECKOUT AREA
    ================================= -->
    <section class="checkout-area padding-top-120px padding-bottom-70px">
        <div class="container">
            <div class="row">
                <div class="col-lg-5">
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title font-size-18">Order Summary</h3>
                        </div>
                        <div class="card-box-shared-body">
                            <div class="shopping-cart-content">
                                <ul class="list-items">
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="primary-color">Original price:</span>
                                        <span class="primary-color-3">$199.99</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                        <span class="primary-color">Coupon discounts:</span>
                                        <span class="primary-color-3">-$181.99</span>
                                    </li>
                                    <li class="d-flex align-items-center justify-content-between font-size-18 font-weight-bold">
                                        <span class="primary-color">Total:</span>
                                        <span class="primary-color-3">$18.99</span>
                                    </li>
                                </ul>
                                <div class="btn-box mt-2">
                                    <p class="font-size-14 mb-2 line-height-22">MAX is required by law to collect
                                        applicable transaction taxes for purchases made in certain tax
                                        jurisdictions.
                                    </p>
                                    <p class="font-size-14 line-height-22 mb-2">By completing your purchase you agree to
                                        these <a href="#" class="primary-color-2">Terms of Service.</a></p>
                                    <a href="checkout.html" class="theme-btn d-block text-center">Proceed</a>
                                </div>
                            </div>
                        </div><!-- end card-box-shared-body -->
                    </div><!-- end card-box-shared -->
                    <div class="card-box-shared">
                        <div class="card-box-shared-title">
                            <h3 class="widget-title font-size-18">Select Payment Method</h3>
                        </div>
                        <div class="card-box-shared-body p-0">
                            <div class="payment-method-wrap">
                                <div class="checkout-item-list">
                                    <div class="accordion" id="paymentMethodExample">
                                        <div class="card">
                                            <div class="card-header" id="headingOne">
                                                <div class="checkout-item">
                                                    <label for="radio-7" class="radio-trigger mb-0"
                                                           data-toggle="collapse" data-target="#collapseOne"
                                                           aria-expanded="true" aria-controls="collapseOne">
                                                        <input type="radio" id="radio-7" name="radio" checked>
                                                        <span class="checkmark"></span>
                                                        <span
                                                            class="widget-title font-size-16">Direct Bank Transfer</span>
                                                    </label>
                                                </div>
                                            </div>
                                            <div id="collapseOne" class="collapse show" aria-labelledby="headingOne"
                                                 data-parent="#paymentMethodExample">
                                                <div class="card-body">
                                                    <p>Make your payment directly into our bank account. Please use your
                                                        Order ID as the payment reference. Your order won’t be shipped
                                                        until the funds have cleared in our account.</p>
                                                </div>
                                            </div>
                                        </div><!-- end card -->
                                        <div class="card">
                                            <div class="card-header" id="headingTwo">
                                                <div
                                                    class="checkout-item d-flex align-items-center justify-content-between">
                                                    <label for="radio-8" class="radio-trigger collapsed mb-0"
                                                           data-toggle="collapse" data-target="#collapseTwo"
                                                           aria-expanded="false" aria-controls="collapseTwo">
                                                        <input type="radio" id="radio-8" name="radio">
                                                        <span class="checkmark"></span>
                                                        <span
                                                            class="widget-title font-size-16">Credit / Debit Card</span>
                                                    </label>
                                                    <span><img src="images/payment-img.png" alt=""></span>
                                                </div>
                                            </div>
                                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                                 data-parent="#paymentMethodExample">
                                                <div class="card-body">
                                                    <div class="contact-form-action">
                                                        <div class="input-box">
                                                            <label class="label-text">Name on Card <span
                                                                    class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <span class="la la-pencil input-icon"></span>
                                                                <input class="form-control" placeholder="Card Name"
                                                                       type="text" name="text" required="">
                                                            </div>
                                                        </div>
                                                        <div class="input-box">
                                                            <label class="label-text">Card Number<span
                                                                    class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <span class="la la-pencil input-icon"></span>
                                                                <input class="form-control" name="text"
                                                                       placeholder="1234  5678  9876  5432" required=""
                                                                       type="text">
                                                            </div>
                                                        </div>
                                                        <div class="input-box">
                                                            <label class="label-text">Expiry Month<span
                                                                    class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <span class="la la-pencil input-icon"></span>
                                                                <input class="form-control" placeholder="MM" required=""
                                                                       name="text" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="input-box">
                                                            <label class="label-text">Expiry Year<span
                                                                    class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <span class="la la-pencil input-icon"></span>
                                                                <input class="form-control" placeholder="YY" required=""
                                                                       name="text" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="input-box">
                                                            <label class="label-text">CVV<span
                                                                    class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <span class="la la-pencil input-icon"></span>
                                                                <input class="form-control" placeholder="CVV"
                                                                       required="" name="text" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="input-box">
                                                            <div class="form-group">
                                                                <div class="custom-checkbox">
                                                                    <input type="checkbox" id="chb2">
                                                                    <label for="chb2">Remember this card</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card -->
                                        <div class="card">
                                            <div class="card-header" id="headingThree">
                                                <div
                                                    class="checkout-item d-flex align-items-center justify-content-between">
                                                    <label for="radio-9" class="radio-trigger collapsed mb-0"
                                                           data-toggle="collapse" data-target="#collapseThree"
                                                           aria-expanded="false" aria-controls="collapseThree">
                                                        <input type="radio" id="radio-9" name="radio">
                                                        <span class="checkmark"></span>
                                                        <span class="widget-title font-size-16">PayPal</span>
                                                    </label>
                                                    <span><img src="images/paypal.png" alt=""></span>
                                                </div>
                                            </div>
                                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                                 data-parent="#paymentMethodExample">
                                                <div class="card-body">
                                                    <div class="contact-form-action">
                                                        <div class="input-box">
                                                            <label class="label-text">First Name<span
                                                                    class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <span class="la la-user input-icon"></span>
                                                                <input class="form-control" placeholder="First name"
                                                                       required="" name="text" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="input-box">
                                                            <label class="label-text">Last Name<span
                                                                    class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <span class="la la-user input-icon"></span>
                                                                <input class="form-control" placeholder="Last name"
                                                                       required="" name="text" type="text">
                                                            </div>
                                                        </div>
                                                        <div class="input-box">
                                                            <label class="label-text">Email Address<span
                                                                    class="primary-color-2 ml-1">*</span></label>
                                                            <div class="form-group">
                                                                <span class="la la-envelope input-icon"></span>
                                                                <input class="form-control" placeholder="Email address"
                                                                       required="" name="email" type="email">
                                                                <p class="mt-2 d-block">In order to complete your
                                                                    transaction, we will transfer you over to PayPal's
                                                                    secure servers.</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end card -->
                                        <div class="card">
                                            <div class="card-header">
                                                <div class="section-block"></div>
                                                <div class="btn-box mt-4">
                                                    <button type="submit" class="theme-btn theme-btn-light mt-2">
                                                        Submit
                                                    </button>
                                                </div>
                                            </div>
                                        </div><!-- end card -->
                                    </div><!-- end accordion -->
                                </div>
                            </div><!-- end payment-method-wrap -->
                        </div><!-- end card-box-shared-body -->
                    </div><!-- end card-box-shared -->
                </div><!-- end col-lg-5 -->
            </div><!-- end row -->
        </div><!-- end container -->
    </section><!-- end checkout-area -->
    <!-- ================================
        END CHECKOUT AREA
    ================================= -->
@endsection
