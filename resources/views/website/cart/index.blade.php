@extends('layouts.app')
@section('title', setting('website_name') . " Shopping Cart")
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
                            <h2 class="section__title">@lang('site.shopping_cart')</h2>
                        </div>
                        <ul class="breadcrumb__list">
                            <li class="active__list-item"><a href="{{ route('home') }}">@lang('site.home')</a></li>
                            <li>@lang('site.shopping_cart')</li>
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
        START CART AREA
    ================================= -->
    <section class="cart-area padding-top-120px padding-bottom-60px">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="shopping-cart-wrap table-responsive">
                        @if(count($items) > 0)
                            <table class="table table-bordered ">
                                <thead class="cart-head">
                                <tr>
                                    <td class="cart__title">@lang('site.image')</td>
                                    <td class="cart__title">@lang('site.course_details')</td>
                                    <td class="cart__title">@lang('site.price')</td>
                                    <td class="cart__title">@lang('site.remove')</td>
                                </tr>
                                </thead>
                                <tbody class="cart-body">
                                @foreach($items as $item)
                                    <tr>
                                        <td>
                                            <a href="{{ route('courses.show', $item->course->slug) }}" class="d-block">
                                                <img src="{{ asset($item->course->small_image) }}"
                                                     alt="{{ $item->course->title }}">
                                            </a>
                                        </td>
                                        <td>
                                            <div class="cart-product-desc">
                                                <a href="{{ route('courses.show', $item->course->slug) }}"
                                                   class="widget-title">{{ $item->course->title }}</a>
                                                <p>
                                                    @lang('site.by') <a
                                                        href="#">{{ $item->course->instructor->name }}</a>
                                                </p>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="item__price">{{ $item->price }} @lang('site.le')
                                                @if($item->after_sale_price)
                                                    <span
                                                        class="before-price">{{ $item->after_sale_price }} @lang('site.le')</span>
                                                @endif
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('cart.destroy', $item->id) }}">
                                                <button type="button" class="button-remove"><i class="fa fa-close"></i>
                                                </button>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                                <tfoot class="cart-foot">
                                <tr>
                                    <td colspan="3">
                                        <a href="{{ route('courses.index') }}"
                                           class="theme-btn">@lang('site.continue_shopping')</a>
                                    </td>
                                    <td colspan="3" class="text-right">
                                        <a href="javascript:void(0);" onclick="window.location.reload();"
                                           class="theme-btn">@lang('site.update_cart')</a>
                                    </td>
                                </tr>
                                </tfoot>
                            </table>
                        @else
                            <div class="w-100 d-flex flex-column align-items-center justify-content-center mb-3">
                                <img src="{{ asset('images/icon-empty-cart.png') }}" alt="Your Cart is Empty"
                                     class="mb-3">
                                <h3 class="mb-3">@lang('site.your_cart_empty')</h3>
                                <a href="{{ route('courses.index') }}">
                                    <button class="theme-btn">@lang('site.browse_courses')</button>
                                </a>
                            </div>
                        @endif
                    </div><!-- end shopping-cart-wrap -->
                </div><!-- end col-lg-12 -->
            </div><!-- end row -->
            @if(count($items) > 0)
                <div class="cart-detail-wrap mt-4">
                    <div class="row">
                        <div class="col-lg-4 ml-auto">
                            <div class="shopping-cart-detail-item">
                                <h3 class="widget-title font-size-20">@lang('site.cart_total')</h3>
                                <div class="shopping-cart-content pt-2">
                                    <ul class="list-items">
                                        <li class="d-flex align-items-center justify-content-between font-weight-semi-bold">
                                            <span class="primary-color">@lang('site.total'):</span>
                                            <span class="primary-color-3">{{ $total }} @lang('site.le')</span>
                                        </li>
                                    </ul>
                                    <div class="btn-box mt-4">
                                        <button class="theme-btn theme-btn-light"
                                                data-toggle="modal"
                                                data-target=".item-confirm-modal">
                                            @lang('site.checkout')
                                        </button>
                                    </div>
                                </div><!-- end shopping-cart-content -->
                            </div><!-- end shopping-cart-detail-item -->
                        </div><!-- end col-lg-4 -->
                    </div><!-- end row -->
                </div>
            @endif
        </div><!-- end container -->
    </section><!-- end cart-area -->
    <!-- ================================
        END CART AREA
    ================================= -->
    <div class="modal-form text-center">
        <div class="modal fade item-confirm-modal" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-md" role="document">
                <div class="modal-content p-4">
                    <div class="modal-top d-flex justify-content-center border-0 mb-4 p-0">
                        <div class="alert-content">
                            <span class="la la-question-circle warning-icon"></span>
                            <h4 class="widget-title font-size-20 mt-2 mb-1">
                                @lang('site.you_will_pay'): <span class="text-bold">{{ $total }}</span> @lang('site.le')
                            </h4>
                            <p class="modal-sub">@lang('site.are_you_want_continue')</p>
                        </div>
                    </div>
                    <form action="{{ route('orders.checkout') }}"
                          method="post" class="d-inline-block">
                        @csrf
                        <div class="btn-box mt-2">
                            <button type="button" class="btn primary-color font-weight-bold mr-3" data-dismiss="modal">
                                @lang('site.cancel')
                            </button>
                            <button type="submit"
                                    class="theme-btn bg-color-2 border-0 text-white">@lang('site.yes_i_will_pay')
                            </button>
                        </div>
                    </form>
                </div><!-- end modal-content -->
            </div><!-- end modal-dialog -->
        </div><!-- end modal -->
    </div><!-- end modal-form -->
@endsection
