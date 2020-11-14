@extends('layouts.theme')

@section('content')

    <div class="blog-breadcrumb-wrapper">
        <div class="container py-3">
            <div class="row">
                <div class="col-md-12">

                    <nav aria-label="breadcrumb">
                        <ol class='breadcrumb mb-0 bg-white p-0'>
                            <li class='breadcrumb-item'>
                                <a href='{{route('blog')}}'>
                                    <i class='la la-home'></i>  {{__t('blog_home')}}
                                </a>
                            </li>

                            <li class='breadcrumb-item active'>{{$title}}</li>
                        </ol>
                    </nav>

                </div>
            </div>
        </div>
    </div>

    <div class="blog-post-page-header bg-dark-blue text-white text-center py-5">
        <div class="container py-3">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    <h1 class="mb-3">{{$title}}</h1>

                    <p>Published time : {{$post->published_time}}</p>
                </div>
            </div>
        </div>
    </div>


    <div class="blog-post-container-wrap py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-10 offset-md-1">
                    @if($post->feature_image)
                        <div class="post-feature-image-wrap mb-5">
                            <img src="{{$post->thumbnail_url->image_lg}}" alt="{{$post->title}}" class="img-fluid">
                        </div>
                    @endif

                    <div class="post-content">
                        {!! clean_html($post->post_content) !!}
                    </div>


                    <div class="blog-author-wrap border p-4 my-5">

                        @php
                            $instructor = $post->author;
                            $courses_count = $instructor->courses()->publish()->count();
                            $students_count = $instructor->student_enrolls->count();
                            $instructor_rating = $instructor->get_rating;
                        @endphp

                        <div class="course-single-instructor-wrap mb-4 d-flex">

                            <div class="instructor-stats">
                                <div class="profile-image mb-4">
                                    <a href="{{route('profile', $instructor->id)}}">
                                        {!! $instructor->get_photo !!}
                                    </a>
                                </div>

                                @if($instructor_rating->rating_count)
                                    <div class="profile-rating-wrap d-flex">
                                        {!! star_rating_generator($instructor_rating->rating_avg) !!}
                                        <p class="m-0 ml-2">({{$instructor_rating->rating_avg}})</p>
                                    </div>
                                @endif

                                <p class="instructor-stat-value mb-1">
                                    <i class="la la-play-circle"></i>
                                    <strong>{{$courses_count}}</strong> {{__t('courses')}}
                                </p>
                                <p class="instructor-stat-value mb-1">
                                    <i class="la la-user-circle"></i>
                                    <strong>{{$students_count}}</strong> {{__t('students')}}
                                </p>
                                <p class="instructor-stat-value mb-1">
                                    <i class="la la-comments"></i>
                                    <strong>{{$instructor_rating->rating_count}} </strong> {{__t('reviews')}}
                                </p>
                            </div>

                            <div class="instructor-details">
                                <a href="{{route('profile', $instructor->id)}}">
                                    <h4 class="instructor-name">{{$instructor->name}}</h4>
                                </a>

                                @if($instructor->job_title)
                                    <h5 class="instructor-designation">{{$instructor->job_title}}</h5>
                                @endif

                                @if($instructor->about_me)
                                    <div class="profle-about-me-text mt-4">
                                        <div class="content-expand-wrap">
                                            <div class="content-expand-inner">
                                                {!! nl2br(clean_html($instructor->about_me)) !!}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>

                    </div>



                </div>
            </div>
        </div>
    </div>


@endsection
