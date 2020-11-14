@extends('layouts.admin')


@section('page-header-right')
    <a href="{{route('payment_settings')}}" class="btn btn-outline-info"> {{__a('payment_settings')}}</a>
@endsection


@section('content')

    <form action="{{route('save_settings')}}" class="form-horizontal" method="post" enctype="multipart/form-data"> @csrf

        <ul class="nav nav-tabs mb-5" id="pills-tab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="stripe-payment-tab" data-toggle="pill" href="#stripe-payment">
                    <i class="lab la-stripe"> </i> Stripe
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="paypal-payment-tab" data-toggle="pill" href="#paypal-payment">
                    <i class="la la-paypal"></i>PayPal
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="bank-payment-tab" data-toggle="pill" href="#bank-payment">
                    <i class="la la-university"></i>
                    Bank Payment
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" id="offline-payment-tab" data-toggle="pill" href="#offline-payment">
                    <i class="la la-wallet"></i>
                    Offline Payment
                </a>
            </li>
        </ul>

        <div class="tab-content" id="payment-settings-tab-wrap">
            <div class="tab-pane fade show active" id="stripe-payment">
                @include('admin.payments.gateways.stripe')
            </div>

            <div class="tab-pane fade" id="paypal-payment">
                @include('admin.payments.gateways.paypal')
            </div>

            <div class="tab-pane fade" id="bank-payment">
                @include('admin.payments.gateways.bank-payment')
            </div>

            <div class="tab-pane fade" id="offline-payment">

                <div class="form-group row">
                    <label class="col-md-4 control-label">{{__a('enable_disable')}} </label>
                    <div class="col-md-8">
                        {!! switch_field('enable_offline_payment', __a('enable_offline_payment'), get_option('enable_offline_payment') ) !!}
                    </div>
                </div>

                <div class="bg-light border p-4">
                    Customer will have a text area where s/he will write details about his favorite payment method. After confirm payment from him. You can set order manually to success. Initially payment status will be <strong>onhold</strong>.
                </div>

            </div>


        </div>


        <hr />

        <div class="form-group row">
            <div class="col-sm-offset-4 col-sm-8">
                <button type="submit" id="settings_save_btn" class="btn btn-primary">
                    {{__a('save_settings')}}
                </button>
            </div>
        </div>

    </form>

@endsection

@section('page-js')
    <script>
        $(document).ready(function(){
            $('input[type="checkbox"], input[type="radio"]').click(function(){
                var input_name = $(this).attr('name');
                var input_value = 0;
                if ($(this).prop('checked')){
                    input_value = $(this).val();
                }
                $.ajax({
                    url : '{{ route('save_settings') }}',
                    type: "POST",
                    data: { [input_name]: input_value, '_token': '{{ csrf_token() }}' },
                });
            });
        });
    </script>
@endsection
