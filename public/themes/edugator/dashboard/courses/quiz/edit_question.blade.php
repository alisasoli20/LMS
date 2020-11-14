<div class="modal " id="editQuestionTypeModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Question Type - {{question_types($question->type)}}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('edit_question')}}" method="post" id="edit-question-form">
                @csrf
                <input type="hidden" name="question_id" value="{{$question->id}}">
                <input type="radio" id="input_option_type_radio" name="question_type" class="d-none" value="radio" checked="checked">

                <div class="modal-body">

                    <div id="questionRequestResponse"></div>

                    <div id="questionTypeFormModal">


                        @if($question->type === 'radio' || $question->type === 'checkbox')


                            <div class="quiz-question-form-wrap question-type-radio bg-white border p-4">

                                <div class="question-basic-info  mb-1 d-flex justify-content-between">
                                    <div class="question-title">
                                        <div class="form-group">
                                            <label>Question Title</label>
                                            <input type="text" name="question_title" class="form-control" value="{{$question->title}}">
                                        </div>
                                    </div>
                                    <div class="question-image-wrap">
                                        <div class="form-group">
                                            <label>Image</label>
                                            {!! image_upload_form('image_id', $question->image_id) !!}
                                        </div>
                                    </div>

                                    <div class="question-score">
                                        <div class="form-group">
                                            <label>Score</label>
                                            <input type="number" name="score" class="form-control" value="{{$question->score}}" >
                                        </div>
                                    </div>
                                </div>

                                <div class="question-options-wrap">

                                    @if($question->options->count())

                                        @foreach($question->options as $option)
                                            <div class="question-opt p-2 my-2" data-type="radio">
                                                <input type="hidden" name="options[{{$loop->iteration}}][option_id]" value="{{$option->id}}">

                                                <div class="form-group m-0">
                                                    <div class="input-group mb-3">
                                                        <div class="input-group-prepend">
                                                            <a href="javascript:;" class="input-group-text question-option-sort"><i class="la la-sort"></i> </a>
                                                        </div>

                                                        <input type="text" class="form-control" name="options[{{$loop->iteration}}][title]" value="{{$option->title}}" placeholder="Option title">
                                                        <div class="input-group-append">
                                                            <a href="javascript:;" class="input-group-text question-opt-trash bg-danger text-white" data-option-id="{{$option->id}}"><i class="la la-trash"></i> </a>
                                                        </div>
                                                    </div>

                                                    <div class="question-opt-footer d-flex mt-3">
                                                        <div class="question-opt-image">
                                                            {!! image_upload_form("options[{$loop->iteration}][image_id]") !!}
                                                        </div>
                                                        <div class="question-opt-display flex-grow-1 ml-4">
                                                            <p class="mb-2">Display preference</p>

                                                            <label class="mr-2">
                                                                <input type="radio" name="options[{{$loop->iteration}}][d_pref]" value="text" {{checked('text', $option->d_pref)}}> Text
                                                            </label>
                                                            <label class="mr-2">
                                                                <input type="radio" name="options[{{$loop->iteration}}][d_pref]" value="image" {{checked('image', $option->d_pref)}} > Image
                                                            </label>
                                                            <label class="mr-2">
                                                                <input type="radio" name="options[{{$loop->iteration}}][d_pref]" value="both" {{checked('both', $option->d_pref)}} > Both
                                                            </label>
                                                        </div>

                                                        <label class="m-0 mt-1 text-right checkbox">
                                                            Correct answer <input type="checkbox" class="is_correct_input" name="options[{{$loop->iteration}}][is_correct]" value="1" {{checked('1', $option->is_correct)}} >
                                                            <span></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>

                                        @endforeach

                                    @endif

                                    <!-- For New Option Purpose -->
                                    <div class="question-opt p-2 my-2 newly" data-type="radio">
                                        <div class="form-group m-0">

                                            <div class="input-group mb-3">
                                                <div class="input-group-prepend">
                                                    <a href="javascript:;" class="input-group-text question-option-sort"><i class="la la-sort"></i> </a>
                                                </div>
                                                <input type="text" class="form-control" name="options[{index}][title]" value="" placeholder="Option title">
                                                <div class="input-group-append">
                                                    <a href="javascript:;" class="input-group-text question-opt-trash bg-danger text-white"><i class="la la-trash"></i> </a>
                                                </div>
                                            </div>

                                            <div class="question-opt-footer d-flex mt-3">
                                                <div class="question-opt-image">
                                                    {!! image_upload_form('options[{index}][image_id]') !!}
                                                </div>
                                                <div class="question-opt-display flex-grow-1 ml-4">
                                                    <p class="mb-2">Display preference</p>

                                                    <label class="mr-2">
                                                        <input type="radio" name="options[{index}][d_pref]" value="text" checked="checked"> Text
                                                    </label>
                                                    <label class="mr-2">
                                                        <input type="radio" name="options[{index}][d_pref]" value="image"> Image
                                                    </label>
                                                    <label class="mr-2">
                                                        <input type="radio" name="options[{index}][d_pref]" value="both"> Both
                                                    </label>
                                                </div>
                                                <label class="m-0 mt-1 text-right checkbox">
                                                    Correct answer <input type="checkbox" class="is_correct_input" name="options[{index}][is_correct]" value="1"><span></span>
                                                </label>

                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>

                        @elseif($question->type === 'text' || $question->type === 'textarea')


                            <div class="quiz-question-form-wrap question-type-radio bg-white border p-4">
                                <div class="question-basic-info  mb-1 d-flex justify-content-between">
                                    <div class="question-title">
                                        <div class="form-group">
                                            <label>Question Title</label>
                                            <input type="text" name="question_title" class="form-control" value="{{$question->title}}">
                                        </div>
                                    </div>
                                    <div class="question-image-wrap">
                                        <div class="form-group">
                                            <label>Image</label>
                                            {!! image_upload_form('image_id', $question->image_id) !!}
                                        </div>
                                    </div>

                                    <div class="question-score">
                                        <div class="form-group">
                                            <label>Score</label>
                                            <input type="number" name="score" class="form-control" value="{{$question->score}}" >
                                        </div>
                                    </div>
                                </div>
                            </div>


                        @endif

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-purple"><i class="la la-save"></i> Save Question</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
