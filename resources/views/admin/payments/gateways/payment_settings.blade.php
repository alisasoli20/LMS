@extends('layouts.admin')


@section('page-header-right')
    <a href="{{route('payment_gateways')}}" class="btn btn-outline-info">{{__a('payment_gateways')}}</a>
@endsection

@section('content')




    <div class="payment-settings-wrap">

        <form method="post">
            @csrf


            <div class="form-group row">
                <label for="enable_instructors_earning" class="col-sm-3 col-form-label">Instructor's Earning</label>
                <div class="col-sm-6">
                    {!! switch_field('enable_instructors_earning', __a('enable'), get_option('enable_instructors_earning') ) !!}
                    <p class="text-muted"> <small>If disable, admin will get all payments</small> </p>
                </div>
            </div>


            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Admin Share %</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="admin_share_input" name="admin_share" value="{{get_option('admin_share')}}">
                    <p class="text-muted"> <small>How much earning will get the admin from each payment. Define the share in the percentage </small> </p>
                </div>
            </div>

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Instructor Share %</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" id="instructor_share_input" name="instructor_share" value="{{get_option('instructor_share')}}">
                    <p class="text-muted"> <small> This share amount will get instructor </small> </p>

                    <div id="share_input_response"></div>
                </div>
            </div>

            <hr />

            <div class="form-group row">
                <label class="col-sm-3 col-form-label">Fees</label>
                <div class="col-sm-6">

                    <div class="d-flex">
                        <div>
                            {!! switch_field('enable_charge_fees', '', get_option('enable_charge_fees')) !!}
                            Enable
                        </div>

                        <div>
                            <p class="mb-1"><input type="text" class="form-control" name="charge_fees_name" value="{{get_option('charge_fees_name')}}" ></p>
                            Fees Name
                        </div>
                        <div>
                            <p class="mb-1">
                                <input type="text" class="form-control" name="charge_fees_amount" value="{{get_option('charge_fees_amount')}}" >
                            </p>
                            Fees Amount
                        </div>
                        <div>
                            <p class="mb-1">
                                <select class="form-control" name="charge_fees_type">
                                    <option value="">Select Fees Type</option>
                                    <option value="percent" {{selected('percent', get_option('charge_fees_type'))}} >Percent</option>
                                    <option value="fixed" {{selected('fixed', get_option('charge_fees_type'))}}>Fixed</option>
                                </select>
                            </p>
                            Fees Type
                        </div>
                    </div>


                    <p class="text-muted my-3"> <small> You can charge an additional fees, like platform charge, or payment gateway charge. </small> </p>
                </div>
            </div>




            <div class="form-group row">
                <div class="offset-sm-3">
                    <button type="submit" id="settings_save_btn" class="btn btn-primary">
                        <i class="la la-save"></i> {{__a('save_settings')}}
                    </button>
                </div>
            </div>

        </form>


    </div>




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
