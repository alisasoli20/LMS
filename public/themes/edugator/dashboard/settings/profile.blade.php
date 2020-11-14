@extends(theme('dashboard.layout'))

@section('content')

    <div class="dashboard-inline-submenu-wrap mb-4 border-bottom">
        <a href="{{route('profile_settings')}}" class="active">Profile Settings</a>
        <a href="{{route('profile_reset_password')}}" class="">Password Reset</a>
    </div>


    <div class="profile-settings-wrap">

        <h4 class="mb-3">Profile Information</h4>

        <form action="" method="post">
            @csrf

            @php
                $user = $auth_user;
                $countries = countries();
            @endphp


            <div class="profile-basic-info bg-white p-3">

                <div class="form-row">
                    <div class="form-group col-md-6 {{ $errors->has('name') ? ' has-error' : '' }}">
                        <label>{{__t('name')}}</label>
                        <input type="tel" class="form-control" name="name" value="{{$user->name}}" >
                        @if ($errors->has('name'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('name') }}</strong></span>
                        @endif
                    </div>

                    <div class="form-group col-md-6 {{ $errors->has('job_title') ? ' has-error' : '' }}">
                        <label>{{__t('job_title')}}</label>
                        <input type="text" class="form-control" name="job_title" value="{{$user->job_title}}">
                        @if ($errors->has('job_title'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('job_title') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>{{__t('phone')}}</label>
                        <input type="text" class="form-control" name="phone" value="{{$user->phone}}">
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{__t('address')}}</label>
                        <input type="text" class="form-control" name="address" value="{{$user->address}}" >
                    </div>
                    <div class="form-group col-md-4">
                        <label>{{__t('address_2')}}</label>
                        <input type="text" class="form-control" name="address_2" value="{{$user->address_2}}" >
                    </div>
                </div>

                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label>{{__t('city')}}</label>
                        <input type="text" class="form-control" name="city" value="{{$user->city}}">
                    </div>

                    <div class="form-group col-md-2">
                        <label>{{__t('zip')}}</label>
                        <input type="text" class="form-control" name="zip_code" value="{{$user->zip_code}}">
                    </div>

                    <div class="form-group col-md-4">
                        <label for="inputState">{{__t('country')}}</label>

                        <select  class="form-control" name="country_id">
                            <option value="">Choose...</option>
                            @foreach($countries as $country)
                                <option value="{{$country->id}}" {{selected($user->country_id, $country->id)}} >{!! $country->name !!}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group col-md-9">
                        <label>{{__t('about_me')}}</label>
                        <textarea class="form-control" name="about_me" rows="5">{{$user->about_me}}</textarea>
                    </div>

                    <div class="form-group col-md-3">
                        <label>{{__t('profile_photo')}}</label>
                        {!! image_upload_form('photo', $user->photo) !!}
                    </div>

                </div>

            </div>


            <h4 class="my-4">Social Link </h4>


            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Website</label>
                    <input type="text" class="form-control" name="social[website]" value="{{$user->get_option('social.website')}}">
                </div>
                <div class="form-group col-md-4">
                    <label>Twitter</label>
                    <input type="text" class="form-control" name="social[twitter]" value="{{$user->get_option('social.twitter')}}" >
                </div>
                <div class="form-group col-md-4">
                    <label>Facebook</label>
                    <input type="text" class="form-control" name="social[facebook]" value="{{$user->get_option('social.facebook')}}" >
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Linkedin</label>
                    <input type="text" class="form-control" name="social[linkedin]" value="{{$user->get_option('social.linkedin')}}">
                </div>
                <div class="form-group col-md-4">
                    <label>Youtube</label>
                    <input type="text" class="form-control" name="social[youtube]" value="{{$user->get_option('social.youtube')}}" >
                </div>
                <div class="form-group col-md-4">
                    <label>Instagram</label>
                    <input type="text" class="form-control" name="social[instagram]" value="{{$user->get_option('social.instagram')}}" >
                </div>
            </div>



            <button type="submit" class="btn btn-purple btn-lg"> Update Profile</button>
        </form>


    </div>


@endsection


@section('page-js')
    <script src="{{ asset('assets/js/filemanager.js') }}"></script>
@endsection
