@extends('layouts.theme')


@section('content')

    @php
        $path = request()->path();
    @endphp

    <div class="page-header-wrapper bg-light-sky py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-12">

                    <nav aria-label="breadcrumb">
                        <ol class='breadcrumb mb-0'>
                            <li class='breadcrumb-item'>
                                <a href='{{route('home')}}'>
                                    <i class='la la-home'></i>  {{__t('home')}}
                                </a>
                            </li>
                            @if($path === 'courses')
                                <li class='breadcrumb-item active'> {{__t('courses')}}</li>
                            @elseif($path === 'popular-courses')
                                <li class='breadcrumb-item active'> <i class="la la-bolt"></i> {{__t('popular_courses')}}</li>
                            @elseif($path === 'featured-courses')
                                <li class='breadcrumb-item active'> <i class="la la-bookmark"></i> {{__t('featured_courses')}}</li>
                            @endif
                        </ol>
                    </nav>
                    <h1 class="mb-3">{{$title}}</h1>
                </div>

            </div>
        </div>

    </div>


    <div class="courses-container-wrap my-5">

        <form action="" id="course-filter-form" method="get">

            <div class="container">

                <div class="row">

                    <div class="col-md-3">


                        <div class="course-filter-wrap">

                            @if(request('q'))
                                <input type="hidden" name="q" value="{{request('q')}}">
                            @endif

                            @php
                                $old_cat_id = request('category');
                                $old_topic_id = request('topic');
                                $old_level = (array) request('level');
                                $old_price = (array) request('price');
                            @endphp


                            @if($categories->count())

                                <div class="course-filter-form-group box-shadow p-3 mb-4">
                                    <div class="form-group">
                                        <h4 class="mb-3">{{__t('category')}}</h4>

                                        <select name="category" id="course_category" class="form-control select2">
                                            <option value="">{{__t('select_category')}}</option>
                                            @foreach($categories as $category)
                                                <optgroup label="{{$category->category_name}}">
                                                    @if($category->sub_categories->count())
                                                        @foreach($category->sub_categories as $sub_category)
                                                            <option value="{{$sub_category->id}}" {{selected($sub_category->id, $old_cat_id)}} >{{$sub_category->category_name}}</option>
                                                        @endforeach
                                                    @endif
                                                </optgroup>
                                            @endforeach
                                        </select>

                                    </div>

                                    <div class="form-group">
                                        <h4 class="mb-3">{{__t('topic')}} <span class="show-loader"></span> </h4>

                                        <select name="topic" id="course_topic" class="form-control select2">
                                            <option value="">{{__t('select_topic')}}</option>

                                            @foreach($topics as $topic)
                                                <option value="{{$topic->id}}" {{selected($topic->id, $old_topic_id)}}>
                                                    {{$topic->category_name}}
                                                </option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                            @endif


                            <div class="course-filter-form-group box-shadow p-3 mb-4">
                                <div class="form-group">
                                    <h4 class="mb-3">{{__t('course_level')}}</h4>
                                    @foreach(course_levels() as $key => $level)
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" name="level[]" value="{{$key}}" {{in_array($key, $old_level) ? 'checked="checked"' : ''}} >
                                            <span class="custom-control-label">{{$level}}</span>
                                        </label>
                                    @endforeach
                                </div>
                            </div>

                            <div class="course-filter-form-group box-shadow p-3 mb-4">
                                <div class="form-group">
                                    <h4 class="mb-3">{{__t('price')}}</h4>

                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="price[]" value="paid" {{in_array('paid', $old_price) ? 'checked="checked"' : '' }} >
                                        <span class="custom-control-label">{{__t('paid')}}</span>
                                    </label>

                                    <label class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="price[]" value="free" {{in_array('free', $old_price) ? 'checked="checked"' : '' }}>
                                        <span class="custom-control-label">{{__t('free')}}</span>
                                    </label>

                                </div>
                            </div>

                            <div class="course-filter-form-group box-shadow p-3 mb-4">
                                <div class="form-group">
                                    <h4 class="mb-3">{{__t('ratings')}}</h4>
                                    <div class="filter-form-by-rating-field-wrap">
                                        <label class="d-flex">
                                            <input type="radio" name="rating" value="4.5" class="mr-2" {{checked('4.5', request('rating'))}} >
                                            {!! star_rating_generator(4.5) !!}
                                            <span class="ml-2">4.5 & Up</span>
                                        </label>
                                        <label class="d-flex">
                                            <input type="radio" name="rating" value="4" class="mr-2" {{checked('4', request('rating'))}}>
                                            {!! star_rating_generator(4) !!}
                                            <span class="ml-2">4.0 & Up</span>
                                        </label>
                                        <label class="d-flex">
                                            <input type="radio" name="rating" value="3" class="mr-2" {{checked('3', request('rating'))}}>
                                            {!! star_rating_generator(3) !!}
                                            <span class="ml-2">3.0 & Up</span>
                                        </label>
                                        <label class="d-flex">
                                            <input type="radio" name="rating" value="2" class="mr-2" {{checked('2', request('rating'))}}>
                                            {!! star_rating_generator(2) !!}
                                            <span class="ml-2">2.0 & Up</span>
                                        </label>
                                        <label class="d-flex">
                                            <input type="radio" name="rating" value="1" class="mr-2" {{checked('1', request('rating'))}}>
                                            {!! star_rating_generator(1) !!}
                                            <span class="ml-2">1.0 & Up</span>
                                        </label>


                                    </div>
                                </div>
                            </div>


                            <div class="course-filter-form-group box-shadow p-3 mb-4">
                                <div class="form-group">
                                    <h4 class="mb-3">{{__t('video_duration')}}</h4>

                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="video_duration" value="0_2" {{checked('0_2', request('video_duration'))}} >
                                        <span class="custom-control-label">{{__t('0_2_hours')}}</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="video_duration" value="3_5" {{checked('3_5', request('video_duration'))}} >
                                        <span class="custom-control-label">{{__t('3_5_hours')}}</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="video_duration" value="6_10" {{checked('6_10', request('video_duration'))}} >
                                        <span class="custom-control-label">{{__t('6_10_hours')}}</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="video_duration" value="11_20" {{checked('11_20', request('video_duration'))}} >
                                        <span class="custom-control-label">{{__t('11_20_hours')}}</span>
                                    </label>
                                    <label class="custom-control custom-radio">
                                        <input type="radio" class="custom-control-input" name="video_duration" value="21" {{checked('21', request('video_duration'))}} >
                                        <span class="custom-control-label">{{__t('21_hours')}}</span>
                                    </label>

                                </div>
                            </div>



                        </div>



                    </div>

                    <div class="col-md-9">

                        <div class="course-sorting-form-wrap form-inline mb-4">

                            <div class="form-group mr-2">
                                <button type="button" id="hide-course-filter-sidebar" class="btn btn-outline-dark">
                                    <i class="la la-filter"></i> Filter  {{count(array_except(array_filter(request()->input()), 'q'))}}
                                </button>
                            </div>

                            <div class="form-group mr-2">
                                <label class="filter-col mr-2">Per page:</label>
                                <select class="form-control" name="perpage">
                                    @for($i = 10; $i<=100; $i = $i + 10)
                                        <option value="{{$i}}" {{selected($i, request('perpage'))}}>{{$i}}</option>
                                    @endfor
                                </select>
                            </div>

                            <div class="form-group">
                                <select class="form-control mr-2" name="sort">
                                    <option value="relevance" {{selected('relevance', request('sort'))}}>Most Relevant</option>
                                    <option value="most-reviewed" {{selected('most-reviewed', request('sort'))}}>Most Reviewed</option>
                                    <option value="highest-rated" {{selected('highest-rated', request('sort'))}}>Highest Rated</option>
                                    <option value="newest" {{selected('newest', request('sort'))}}>Newest</option>
                                    <option value="price-low-to-high" {{selected('price-low-to-high', request('sort'))}}>Lowest Price</option>
                                    <option value="price-high-to-low" {{selected('price-high-to-low', request('sort'))}}>Highest Price</option>
                                </select>
                            </div>


                            <div class="form-group ml-auto">
                                <a href="{{route('courses')}}" class="btn btn-link"> <i class="la la-refresh"></i> Clear Filter</a>
                            </div>
                        </div>


                        @if($courses->count())
                            <p class="text-muted mb-3"> Showing {{$courses->count()}} from {{$courses->total()}} results </p>

                            <div class="row">
                                @foreach($courses as $course)
                                    {!! course_card($course, 'col-md-4') !!}
                                @endforeach
                            </div>
                        @else
                            {!! no_data() !!}
                        @endif

                        {!! $courses->links() !!}

                    </div>

                </div>

            </div>



        </form>

    </div>


@endsection
