@extends('layouts.admin')

@section('content')
    <form action="" id="form-category" method="post" > @csrf

        <div class="row">

            <div class="col-md-12">

                <div class="form-group row {{ $errors->has('username')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="category_name">@lang('admin.name')</label>
                    <div class="col-sm-7">
                        <input type="text" name="username" value="" placeholder="@lang('admin.name')" id="category_name" class="form-control">
                        {!! $errors->has('username')? '<p class="help-block">'.$errors->first('username').'</p>':'' !!}
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('email')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="email">@lang('admin.email')</label>
                    <div class="col-sm-7">
                        <input type="email" name="email" value="" placeholder="@lang('admin.email')" id="email" class="form-control">
                        {!! $errors->has('email')? '<p class="help-block">'.$errors->first('email').'</p>':'' !!}
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('passowrd')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="email">@lang('admin.password')</label>
                    <div class="col-sm-7">
                        <input type="password" name="password" value="" placeholder="@lang('admin.password')" id="passsword" class="form-control">
                        {!! $errors->has('password')? '<p class="help-block">'.$errors->first('password').'</p>':'' !!}
                    </div>
                </div>
                <div class="form-group row {{ $errors->has('password_confirmation')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="email">@lang('admin.password_confirmation')</label>
                    <div class="col-sm-7">
                        <input type="password_confirmation" name="password_confirmation" value="" placeholder="@lang('admin.password_confirmation')" id="confirm_password" class="form-control">
                        {!! $errors->has('password_confirmation')? '<p class="help-block">'.$errors->first('password_confirmation').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label" for="gender">@lang('admin.gender')</label>
                    <div class="col-sm-7">
                        <label><input type="radio" name="gender" value="1" checked="checked"> {{__a('male')}}</label> <br />
                        <label><input type="radio" name="gender" value="0"> {{__a('female')}}</label>
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('select_instructor')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="select_instructor">@lang('admin.instructor')</label>
                    <div class="col-sm-7">
                        <select name="select_instructor" id="select_instructor" class="form-control select2">
                            @if($instructors->count() > 0)
                                @foreach($instructors as $instructor)
                                    <option value="{{ $instructor->id }}"> {{  $instructor->name  }}</option>
                                @endforeach
                            @endif
                        </select>

                        {!! $errors->has('select_instructor')? '<p class="help-block">'.$errors->first('select_instructor').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('user_type')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="email">@lang('admin.user_type')</label>
                    <div class="col-sm-7">
                        <input type="text" name="user_type" value="student" placeholder="@lang('admin.user_type')" id="confirm_password" class="form-control" readonly>
                        {!! $errors->has('user_type')? '<p class="help-block">'.$errors->first('user_type').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-7 offset-3">
                        <button type="submit" form="form-category" class="btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')"> <i class="la la-save"></i> {{__a('save')}} </button>
                    </div>
                </div>


            </div>

        </div>

    </form>
@endsection