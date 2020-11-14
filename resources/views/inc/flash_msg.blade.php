@if(session('success'))
    <div class="alert alert-success">
        <i class="la la-check-circle"></i> {!! session('success') !!}
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger">
        <i class="la la-info-circle"></i> {!! session('error') !!}
    </div>
@endif

@if($errors->count() > 0)
    <div class="alert alert-danger">
        <i class="la la-info-circle"></i> @lang('admin.form_error')
    </div>
@endif
