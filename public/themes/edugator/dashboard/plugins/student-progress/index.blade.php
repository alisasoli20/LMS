@extends(theme('dashboard.layout'))

@section('content')

    @php
    $course = \App\Course::find($course_id);
    $students  = $course->students()->with('photo_query')->orderBy('enrolls.enrolled_at', 'desc')->paginate(50);
    @endphp

    @if($students->total())

        <h4 class="mb-4">Progress Report for the course : <span class="text-muted">{{$course->title}}</span></h4>

        <table class="table table-bordered bg-white">

            <tr>
                <td colspan="2">Students</td>
                <td width="30">Progress</td>
                <td width="30"></td>
            </tr>

        @foreach($students as $student)
            @php
            $completed_percent = $course->completed_percent($student);
            @endphp

            <tr>
                <td width="30">
                    <div class="reviewed-user-photo m-0">
                        <a href="{{route('profile', $student->id)}}">
                            {!! $student->get_photo !!}
                        </a>
                    </div>
                </td>
                <td>
                    <div class="progress-report-loop-detail w-100">
                        <a href="{{route('profile', $student->id)}}" class="mb-2 d-block" >{!! $student->name !!}</a>

                        <div class="progress">
                            <div class="progress-bar bg-success" style="width: {{$completed_percent}}%"></div>
                        </div>

                    </div>

                </td>
                <td>{{$completed_percent}}%</td>
                <td><a href="{{route('progress_report_details', [$course->id, $student->id])}}" class="btn btn-purple btn-sm">Details</a> </td>
            </tr>
        @endforeach

        </table>

        {!! $students->links() !!}

    @else
        {!! no_data(null, null, 'my-5' ) !!}
    @endif


@endsection
