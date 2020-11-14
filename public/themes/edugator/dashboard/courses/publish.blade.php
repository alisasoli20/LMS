@extends(theme('dashboard.layout'))


@section('content')

    @include(theme('dashboard.courses.course_nav'))

    <form action="" method="post">
        @csrf

        <div class="row">
            <div class="col-md-10 offset-md-1 mt-3">
                <div class="publish-course-wrap">

                    @if( ! $course->status)
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3>Draft</h3>
                            </div>
                            <div class="card-body  pt-3 pb-5 text-center">
                                <p class="course-publish-icon m-0">
                                    <i class="la la-pencil-square-o"></i>
                                </p>
                                <p class="pl-5 pr-5">
                                    Your course is in a draft state. Students cannot view, purchase or enroll in this course. For students that are already enrolled, this course will not appear on their student Dashboard.
                                </p>
                            </div>
                            <div class="card-footer text-center">
                                @if(get_option("lms_settings.instructor_can_publish_course"))
                                    <button type="submit" class="btn btn-dark btn-lg" name="publish_btn" value="publish"><i class="la la-arrow-circle-up"></i> Publish Course</button>
                                @else
                                    <button type="submit" class="btn btn-dark btn-lg" name="publish_btn" value="publish"><i class="la la-arrow-circle-up"></i> Submit for review</button>
                                @endif
                            </div>
                        </div>

                    @elseif($course->status == 1)
                        <div class="text-center">
                            <div class="alert alert-success py-5">
                                <p class="course-publish-icon m-0"> <i class="la la-smile-o"></i></p>
                                <h3>Your course has been published</h3>
                            </div>

                            <button type="submit" class="btn btn-warning btn-lg mt-4" name="publish_btn" value="unpublish"><i class="la la-arrow-circle-down"></i> Unpublish Course</button>
                        </div>
                    @elseif($course->status == 2)
                        <div class="card">
                            <div class="card-header d-flex">
                                <h3>Pending...</h3>
                            </div>
                            <div class="card-body  pt-3 pb-5 text-center">
                                <p class="course-publish-icon m-0">
                                    <i class="la la-clock-o"></i>
                                </p>
                                <p class="pl-5 pr-5">
                                    Your course is in pending state. Course will be available to public after review by a reviewer.
                                </p>
                            </div>
                        </div>

                    @elseif($course->status == 4)
                        <div class="text-center">
                            <div class="alert alert-warning py-5">
                                <p class="course-publish-icon m-0"> <i class="la la-exclamation-circle"></i></p>
                                <h3>Your course is in a unpublish state </h3>
                            </div>

                            @if(get_option("lms_settings.instructor_can_publish_course"))
                                <button type="submit" class="btn btn-success btn-lg mt-4" name="publish_btn" value="publish"><i class="la la-arrow-circle-up"></i> Publish Course</button>
                            @else
                                <button type="submit" class="btn btn-dark btn-lg mt-4" name="publish_btn" value="publish"><i class="la la-arrow-circle-up"></i> Submit for review</button>
                            @endif

                        </div>

                    @elseif($course->status == 3)
                        <div class="text-center">
                            <div class="alert alert-danger py-5">
                                <p class="course-publish-icon m-0"> <i class="la la-frown"></i></p>
                                <h3>Your course has been blocked </h3>
                            </div>
                        </div>
                    @endif



                </div>

            </div>
        </div>

    </form>



@endsection
