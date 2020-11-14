@extends('layouts.theme')


@section('content')

    @php
        $courses = $user->courses()->publish()->get();
        $students_count = $user->student_enrolls->count();
        $rating = $user->get_rating;
    @endphp

    <div class="container">


        <div class="profile-page-wrap d-flex py-5">

            <div class="profile-page-sidebar mr-4">

                <div class="profile-image mr-4 text-center">
                    {!! $user->get_photo !!}
                </div>

                <p class="profile-social-icon-wrap mt-4">
                    @if($user->get_option('social'))
                        @foreach($user->get_option('social') as $socialKey => $social)
                            @if($social)
                                <a title="{{ucfirst($socialKey)}}" href="{{$social}}" class="d-block border py-2 px-3 mb-1" target="_blank">
                                    <i class="la la-{{$socialKey === 'website' ? 'link' : $socialKey}}"></i>
                                    {{ucfirst($socialKey)}}
                                </a>
                            @endif
                        @endforeach
                    @endif
                </p>

            </div>

            <div class="profile-page-content-wrap flex-grow-1">

                <div class="profle-page-header mb-4 border-bottom">
                    @if($user->isInstructor)
                        <label class="badge badge-info">{{__t('instructor')}}</label>
                    @else
                        <label class="badge badge-dark">{{__t('student')}}</label>
                    @endif

                    <h1 class="profile-name">{{$user->name}}</h1>
                    @if($user->job_title)
                        <h3 class="profile-designation">{{$user->job_title}}</h3>
                    @endif

                    @if($rating->rating_count)
                        <div class="my-3 profile-rating-wrap d-flex">
                            {!! star_rating_generator($rating->rating_avg) !!}
                            <p class="m-0 ml-3">({{$rating->rating_avg}})</p>
                        </div>
                    @endif

                    @if($user->isInstructor)

                        <div class="profile-stat-wrap d-flex mt-2">
                            @if($courses->count())
                                <div class="profile-stat mr-4">
                                    <p class="profile-stat-title mb-0">{{__t('courses')}}</p>
                                    <p class="profile-stat-value">{{$courses->count()}}</p>
                                </div>
                            @endif
                            @if($students_count)
                                <div class="profile-stat mr-4">
                                    <p class="profile-stat-title mb-0">{{__t('students')}}</p>
                                    <p class="profile-stat-value">{{$students_count}}</p>
                                </div>
                            @endif
                            <div class="profile-stat mr-4">
                                <p class="profile-stat-title mb-0">{{__t('reviews')}}</p>
                                <p class="profile-stat-value">{{$rating->rating_count}}</p>
                            </div>
                        </div>
                    @endif


                </div>

                @if($user->about_me)
                    <h4 class="mb-4">{{__t('about_me')}}</h4>

                    <div class="profle-about-me-text">
                        <div class="content-expand-wrap">
                            <div class="content-expand-inner">
                                {!! nl2br($user->about_me) !!}
                            </div>
                        </div>
                    </div>
                @endif

                @if($courses->count())
                    <h4 class="my-4">{{__t('my_courses')}}</h4>

                    <div class="row">
                        @foreach($courses as $course)
                            {!! course_card($course, 'col-md-4 col-sm-6') !!}
                        @endforeach
                    </div>

                @endif

            </div>

        </div>




    </div>



@endsection
