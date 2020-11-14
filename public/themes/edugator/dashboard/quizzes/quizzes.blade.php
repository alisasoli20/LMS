@extends(theme('dashboard.layout'))


@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('courses_has_quiz')}}">{{__t('courses')}}</a></li>
            <li class="breadcrumb-item"> <a href="{{route('courses_quizzes', $course->id)}}">{{__t('quizzes')}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{__t('quiz_attempts')}}</li>
            <li class="breadcrumb-item active">{{__t('review')}}</li>
        </ol>
    </nav>

    @php
        $quizzes = $course->quizzes()->with('attempts')->paginate(50);
    @endphp

    @if($quizzes->total())
        <table class="table table-bordered bg-white table-striped">
            @foreach($quizzes as $quiz)
                <tr>
                    <td>
                        <div class="d-flex">
                            <div class="quizzes flex-grow-1">

                                <a href="{{route('quiz_attempts', $quiz->id)}}">
                                    {{$quiz->title}}
                                </a>
                                <p class="mb-0">
                                    <small class="text-muted">{!! __t('quiz_attempts') !!} : {{$quiz->attempts->count()}}</small>
                                </p>
                            </div>
                            <div class="attempts-btn-wrap">
                                <a href="{{route('quiz_attempts', $quiz->id)}}" class="btn btn-dark-blue py-0">{{__t('attempts')}}</a>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </table>

        {!! $quizzes->links() !!}

    @else
        {!! no_data() !!}
    @endif


@endsection
