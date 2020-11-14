@extends('layouts.theme')

<!-- Main Content -->
@section('content')

<div class="container my-5">
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <div class="card">

                <div class="card-body p-5">

                    <h3 class="mb-4">{{__t('reset_your_password')}}</h3>

                    @include('inc.flash_msg')

                    <form action="" class="form-horizontal" method="post">
                        @csrf

                        <div class="form-group {{ $errors->has('password')? 'has-error':'' }} ">
                            <label class="control-label">{{__t('password')}}</label>

                            <input type="password" name="password" id="password" class="form-control"  value="{{ old('password') }}" placeholder="{{__t('password')}}">
                            {!! $errors->has('password')? '<p class="help-block">'.$errors->first('password').'</p>':'' !!}
                        </div>

                        <div class="form-group {{ $errors->has('password_confirmation')? 'has-error':'' }} ">
                            <label class="control-label">{{__t('confirm_password')}}</label>

                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control"  value="{{ old('password_confirmation') }}" placeholder="{{__t('confirm_password')}}">
                            {!! $errors->has('password_confirmation')? '<p class="help-block">'.$errors->first('password_confirmation').'</p>':'' !!}
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="la la-unlock"></i> {{__t('reset_password')}}</button>
                        </div>
                    </form>


                </div>


            </div>
        </div>
    </div>
</div>

@endsection
