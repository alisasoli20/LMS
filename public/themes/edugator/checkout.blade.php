@extends('layouts.theme')


@section('content')

    @if(cart()->count)

        <div class="checkout-page-wrap py-5">

            <div class="container">
                <div class="row">

                    <div class="col-md-8">

                        <div class="section-order-summery-wrap mb-5">
                            <h4 class="mb-4">{{__t('order_summery')}}</h4>

                            <div class="checkout-section order-summery-wrap bg-white p-4">
                                @php($cart = cart())

                                @if($cart->count)
                                    <div class="order-summery-courses-wrap">
                                        @foreach($cart->courses as $cart_course)
                                            <div class="order-summery-course-item border-bottom pb-3 mb-3">
                                                <a href="{{array_get($cart_course, 'course_url')}}" class="d-block d-flex">

                                                    <div class="order-summery-course-thumbnail mr-2">
                                                        <img src="{{array_get($cart_course, 'thumbnail')}}" class="img-fluid img-thumbnail" />
                                                    </div>

                                                    <p class="order-summery-course-title flex-grow-1"> {{$cart_course['title']}}</p>

                                                    <div class="order-summery-course-info ">
                                                        <div class="order-summery-course-price">
                                                            {!! price_format(array_get($cart_course, 'price')) !!}
                                                        </div>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    </div>

                                    @if($cart->enable_charge_fees)

                                        <div class="order-summery-fees-wrap d-flex border-bottom mb-3 pb-3">
                                            <h5 class="flex-grow-1">
                                                {!! $cart->fees_name !!}
                                                ({!! $cart->fees_type === 'percent' ? $cart->fees_amount.'%' : '' !!})
                                            </h5>
                                            <strong>+ {!! price_format($cart->fees_total) !!}</strong>
                                        </div>

                                    @endif

                                    <div class="order-summery-total-wrap d-flex">
                                        <h5 class="flex-grow-1">{{__t('total')}}</h5>
                                        <strong>{!! price_format($cart->total_amount) !!}</strong>
                                    </div>
                                @endif
                            </div>

                        </div>


                        <div class="section-account-information-wrap mb-5">
                            <h4>{{__t('account_information')}}</h4>

                            <div class="checkout-section order-account-information-wrap bg-white p-4 mt-3">
                                <p class="checkout-logged-email d-flex">
                                    <i class="la la-user"></i>

                                    <span class="mr-2"> {{__t('logged_in_as')}} </span>
                                    <strong class="flex-grow-1">{{$auth_user->name}}</strong>

                                    <a href="{{ route('logout') }}"
                                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="la la-sign-out"></i> {{__t('logout')}}
                                    </a>
                                </p>

                                <p class="checkout-logged-email">
                                    <i class="la la-envelope"></i> {{__t('email')}} <strong>{{$auth_user->email}}</strong>
                                </p>
                            </div>
                        </div>

                        @include(theme('template-part.gateways.available-gateways'))

                        <div class="checkout-agreement-wrap mt-4 text-center text-muted">
                            <p class="agreement-text"> {{__t('agreement_text')}} <br />
                                <strong>{{get_option('site_name')}}'s</strong>
                                <a href="{{route('post_proxy', get_option('terms_of_use_page'))}}">
                                    {{__t('terms_of_use')}}
                                </a> &amp; <a href="{{route('post_proxy', get_option('privacy_policy_page'))}}">
                                    {{__t('privacy_policy')}}
                                </a>
                            </p>
                        </div>

                    </div>

                </div>
            </div>

        </div>

    @else
        <div class="text-center my-5">
            <h2 class="mb-4 mt-5"><i class="la la-frown"></i> {{__t('nothing_to_checkout')}} </h2>
            <a href="{{route('home')}}" class="btn btn-lg btn-warning mb-5"> <i class="la la-home"></i> {{__t('go_to_home')}}</a>
        </div>
    @endif

@endsection

@section('page-js')
    @include(theme('template-part.gateways.gateway-js'))
@endsection
