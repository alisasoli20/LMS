@extends('layouts.admin')

@section('content')

    <div class="row">
        <div class="col-md-10 col-xs-12">

            <form action="{{route('save_settings')}}" method="post"> @csrf

                @php
                    $pages = get_pages();
                @endphp

                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">@lang('admin.logo') </label>
                    <div class="col-sm-8">
                        {!! image_upload_form('site_logo', get_option('site_logo')) !!}
                    </div>
                </div>

                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">{!! __a('about_us_page') !!} </label>
                    <div class="col-sm-8">

                        <select name="about_us_page">
                            <option value="">Select page</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}" {{selected($page->id, get_option('about_us_page'))}} >{{$page->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">{!! __a('privacy_policy_page') !!} </label>
                    <div class="col-sm-8">
                        <select name="privacy_policy_page">
                            <option value="">Select page</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}" {{selected($page->id, get_option('privacy_policy_page'))}} >{{$page->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="additional_css" class="col-sm-4 control-label">{!! __a('terms_of_use_page') !!} </label>
                    <div class="col-sm-8">
                        <select name="terms_of_use_page">
                            <option value="">Select page</option>
                            @foreach($pages as $page)
                                <option value="{{$page->id}}" {{selected($page->id, get_option('terms_of_use_page'))}} >{{$page->title}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>



                <legend class="my-4">@lang('admin.cookie_settings')</legend>

                <div class="form-group row {{ $errors->has('enable_cookie_alert')? 'has-error':'' }}">
                    <label class="col-md-4 control-label">@lang('admin.enable_disable') </label>
                    <div class="col-md-8">
                        <label for="enable_cookie_alert" class="checkbox-inline">
                            <input type="checkbox" value="1" id="enable_cookie_alert" name="cookie_alert[enable]" {{checked(1, get_option('cookie_alert.enable'))}} >
                            @lang('admin.enable_cookie_alert')
                        </label>
                    </div>
                </div>

                <div class="form-group row">
                    <label for="cookie_message" class="col-sm-4 control-label">@lang('admin.cookie_message')</label>
                    <div class="col-sm-8">
                        <textarea class="form-control" id="cookie_message" name="cookie_alert[message]" rows="6">{!! get_option('cookie_alert.message') !!}</textarea>
                        <p class="text-muted my-3"> <small>variable <code>{privacy_policy_url}</code> will print privacy policy link</small> </p>
                    </div>
                </div>

                <hr />
                <div class="form-group row">
                    <div class="col-sm-offset-4 col-sm-8">
                        <button type="submit" id="settings_save_btn" class="btn btn-primary">@lang('admin.save_settings')</button>
                    </div>
                </div>

            </form>

        </div>
    </div>


@endsection
