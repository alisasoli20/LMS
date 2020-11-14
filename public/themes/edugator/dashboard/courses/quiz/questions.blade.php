
@php
    $questions = $quiz->questions;
@endphp

@if($questions->count())
    @foreach($questions as $question)
        <div id="question-{{$question->id}}" class="quiz-question-item  input-group mb-3">

            <div class="input-group-prepend">
                <a href="javascript:;" class="input-group-text question-sort"><i class="la la-sort"></i> </a>
                <span class="input-group-text"><i class=" la la-question-{{$question->type}}"></i></span>

                @if($question->image_id)
                    <span class="input-group-text p-0">
                        <img src="{{$question->image_url->thumbnail}}" class="quiz-question-item-image" />
                    </span>
                @endif
            </div>

            <p class="bg-light border m-0 px-3 py-2 quiz-question-item-title">
                <span class="question-title">{{$question->title}}</span>
            </p>
            <div class="input-group-append">
                <a href="javascript:;" class="input-group-text question-edit" data-question-id="{{$question->id}}"><i class="la la-pencil-square"></i> </a>
                <a href="javascript:;" class="input-group-text question-trash bg-danger text-white" data-question-id="{{$question->id}}"><i class="la la-trash"></i> </a>
            </div>

        </div>
    @endforeach
@endif
