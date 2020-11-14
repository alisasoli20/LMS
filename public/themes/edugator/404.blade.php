@extends('layouts.theme')

@section('content')


    <div class="container">

        <div class="row">
            <div class="col-md-6 offset-md-3">
                <div class="error-page-wrap text-center py-5">

                    <div class="error-page-img">
                        <img src="{{asset('assets/images/404.png')}}" class="img-fluid" />
                    </div>

                    @if($exception->getMessage())
                        <h3 class="mb-3">{{$exception->getMessage()}}</h3>
                    @endif

                    <div class="error-actions">
                        <a href="{{route('home')}}" class="btn btn-theme-primary btn-lg">
                            <span class="la la-home"></span> Back to home
                        </a>
                    </div>
                </div>
            </div>
        </div>

    </div>


@endsection
