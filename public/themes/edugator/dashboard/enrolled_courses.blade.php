@extends(theme('dashboard.layout'))

@section('content')

    @if($auth_user->enrolls->count())
        <table class="table table-bordered bg-white">

            <tr>
                <th>{{__t('thumbnail')}}</th>
                <th>{{__t('title')}}</th>
                <th>{{__t('price')}}</th>
                <th>#</th>
            </tr>

            @foreach($auth_user->enrolls as $course)
                <tr>
                    <td>
                        <img src="{{$course->thumbnail_url}}" width="80" />
                    </td>
                    <td>
                        <p class="mb-3">
                            <strong>{{$course->title}}</strong>
                            {!! $course->status_html() !!}
                        </p>

                        <p class="m-0 text-muted">
                            @php
                            $lectures_count = $course->lectures->count();
                            $assignments_count = $course->assignments->count();
                            $quizzes_count = $course->quizzes->count();
                            @endphp

                            <span class="course-list-lecture-count">{{$lectures_count}} {{__t('lectures')}}</span>

                            @if($assignments_count)
                                , <span class="course-list-assignment-count">{{$assignments_count}} {{__t('assignments')}}</span>
                            @endif

                            @if($quizzes_count)
                                , <span class="course-list-assignment-count">{{$quizzes_count}} {{__t('quizzes')}}</span>
                            @endif

                        </p>
                    </td>
                    <td>{!! $course->price_html() !!}</td>

                    <td>
                        @if($course->status == 1)
                            <a href="{{route('course', $course->slug)}}" class="btn btn-sm btn-primary mt-2" target="_blank"><i class="la la-eye"></i> {{__t('view')}} </a>
                        @endif
                    </td>
                </tr>

            @endforeach

        </table>
    @else
        {!! no_data(null, null, 'my-5' ) !!}
    @endif

@endsection
