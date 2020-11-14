@extends(theme('dashboard.layout'))


@section('content')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('courses_has_assignments')}}">{{__t('courses')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('courses_assignments', $submission->course_id)}}">{{__t('assignments')}}</a></li>
            <li class="breadcrumb-item"><a href="{{route('assignment_submissions', $submission->assignment_id)}}">{{__t('assignment_submission')}}</a></li>
            <li class="breadcrumb-item active">{{__t('evaluate_submission')}}</li>
        </ol>
    </nav>


    <div class="assignment-submission-wrap">


        <div class="assignment-submission-header mb-4 alert alert-light">

            <h4>Course: <a href="{{course_url($submission->course)}}">{{$submission->course->title}}</a> </h4>
            <h4>Assignment: <a href="{{route('single_assignment', [$submission->course->slug, $submission->assignment_id])}}" >{{$submission->assignment->title}}</a> </h4>

            @if($submission->is_evaluated)
                <div class="alert alert-success mt-4">
                    <h5 class="text-success mt-2"><i class="la la-check-circle-o"></i> {{__t('submission_evaluated')}} </h5>
                    <p class="text-muted m-0"> {{__t('evaluated_by')}}: <strong>{{$submission->instructor->name}}</strong></p>
                    <p class="text-muted"> Evaluated at: {{$submission->evaluated_at->format(date_time_format())}}</p>
                </div>
            @endif

        </div>


        <div class="submission-evaluation-form bg-light p-4 border my-4">

            <form action="" method="post">
                @csrf

                <h4 class="mb-4"><i class="la la-book-reader"></i> Assignment Evaluation Form</h4>

                <div class="form-group row {{ $errors->has('give_numbers') ? ' has-error' : '' }}">

                    <label class="col-sm-3">{{__t('give_numbers')}}</label>

                    <div class="col-sm-9">
                        <input type="text" name="give_numbers" class="form-control" id="title" value="{{$submission->earned_numbers}}" >
                        <small class="form-text text-muted">Give your numbers to this assignment submission. Out of <strong> {{$submission->assignment->option('total_number')}}</strong></small>

                        @if ($errors->has('give_numbers'))
                            <span class="invalid-feedback"><strong>{{ $errors->first('give_numbers') }}</strong></span>
                        @endif
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3">{{__t('evaluation_notes')}}</label>
                    <div class="col-sm-9">
                        <textarea name="evaluation_notes" id="evaluation_notes" class="form-control">{!! $submission->instructors_note !!}</textarea>
                        <small class="form-text text-muted">Write a note about what are you thinking about this submission and you would like to let this student know. such as "You need to improved your skills."</small>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-9 offset-sm-3">
                        <button type="submit" class="btn btn-info btn-lg">Evaluate this submission</button>
                    </div>
                </div>



            </form>

        </div>


        @if($submission->text_submission)
            <h5>{{__t('submission_text')}}</h5>

            <div class="assignment-submission-text-wrap border bg-white p-3 my-3">
                {!! $submission->text_submission !!}
            </div>
        @endif

        @if($submission->attachments->count())
            <div class="lecture-attachments bg-white border p-3 mt-4">
                <h5 class="lecture-attachments-title mb-3">{{__t('attachments')}}</h5>
                @foreach($submission->attachments as $attachment)
                    @if($attachment->media)
                        <a href="{{route('attachment_download', $attachment->hash_id)}}" class="lecture-attachment mb-2 d-block">
                            <i class="la la-cloud-download mr-2"></i>
                            {{$attachment->media->slug_ext}} <small class="text-muted">({{$attachment->media->readable_size}})</small>
                        </a>
                    @endif
                @endforeach
            </div>
        @endif
    </div>


@endsection

@section('page-js')
    <script src="{{ asset('assets/plugins/ckeditor/ckeditor.js') }}"></script>
    <script>
        CKEDITOR.replace( 'evaluation_notes', {removeButtons: 'Image,RemoveFormat,Source,Subscript,Superscript,Table,HorizontalRule,SpecialChar'} );
    </script>
@endsection
