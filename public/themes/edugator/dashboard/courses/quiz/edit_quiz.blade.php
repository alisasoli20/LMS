<div class="section-item-form-html  p-4 border">

    <div class="new-quiz-form-header d-flex mb-3 pb-3 border-bottom">
        <h5 class="flex-grow-1">{{__t('edit_'.$item->item_type)}}</h5>
        <a href="javascript:;" class="btn btn-outline-dark btn-sm btn-cancel-form" ><i class="la la-close"></i> </a>
    </div>

    <div class="curriculum-item-edit-tab list-group list-group-horizontal-md mb-3 text-center  ">
        <a href="javascript:;" data-tab="#quiz-basic" class="list-group-item list-tab-item list-group-item-action list-group-item-secondary active ">
            <i class="la la-file-text"></i> {{__t('basic')}}
        </a>
        <a href="javascript:;" id="quiz-questions-tab-item" data-tab="#quiz-questions" class="list-group-item list-tab-item list-group-item-action list-group-item-secondary ">
            <i class="la la-question-circle"></i> {{__t('questions')}}
        </a>
        <a href="javascript:;" data-tab="#quiz-settings" class="list-group-item list-tab-item list-group-item-action list-group-item-secondary ">
            <i class="la la-cog"></i> {{__t('settings')}}
        </a>
    </div>

    <form class="curriculum-edit-quiz-form" action="{{route('update_quiz', [$item->course_id, $item->id])}}" method="post">
        @csrf

        <div class="quiz-request-response"></div>

        <div id="quiz-basic" class="section-item-tab-wrap" style="display: block;">
            <div class="form-group">
                <label for="title">{{__t('title')}}</label>
                <input type="text" name="title" class="form-control" id="title" value="{{$item->title}}"  >
            </div>

            <div class="form-group">
                <label for="description">{{__t('description')}}</label>
                <textarea name="description" class="form-control ajaxCkeditor" rows="5">{!! $item->text !!}</textarea>
            </div>

            <!-- Quiz Save Button -->
            <div class="form-group">
                <button type="button" class="btn btn-outline-info btn-cancel-form"> {{__t('cancel')}}</button>
                <button type="submit" class="btn btn-info btn-edit-quiz"  name="save" value="save_next"> <i class="la la-save"></i> {{__t('save_'.$item->item_type)}}</button>
            </div>

        </div>

        <div id="quiz-questions" class="section-item-tab-wrap mb-5" style="display: none;">

            <div id="quiz-questions-wrap" class="mb-4">
                @include(theme('dashboard.courses.quiz.questions'), ['quiz' => $item])
            </div>

            <button type="button" id="quiz-add-question-btn" class="btn btn-success btn-lg btn-block mt-5">
                <i class="la la-plus-circle"></i> Add Question
            </button>


        </div>


        <div id="quiz-settings" class="section-item-tab-wrap" style="display: none;">


            <div id="quiz-settings-wrap">

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Gradable</label>
                    <div class="col-sm-8">
                        {!! switch_field('quiz_gradable', __t('Quiz Gradable'), $item->quiz_gradable) !!}
                        <p class="text-muted">
                            <small>If this quiz test affect on the students grading system for this course.</small>
                        </p>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">Remaining time display</label>
                    <div class="col-sm-8">
                        {!! switch_field('quiz_option[show_time]', __t('Show Time'), $item->option('show_time')) !!}
                        <p class="text-muted">
                            <small>By enabling this option, quiz taker will show remaining time during attempt.</small>
                        </p>
                    </div>
                </div>


                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Time Limit</label>
                        <div class="input-group">
                            <input type="number" class="form-control" name="quiz_option[time_limit]" value="{{$item->option('time_limit')}}">
                            <div class="input-group-append">
                                <span class="input-group-text">Minutes</span>
                            </div>
                            <p class="text-muted"><small>Set zero to disable time limit.</small></p>
                        </div>
                    </div>

                    <div class="form-group  col-md-4">
                        <label>Passing Score (%)</label>
                        <input type="number" class="form-control" name="quiz_option[passing_score]" value="{{$item->option('passing_score')}}">
                        <p class="text-muted"><small>Student have to collect this score in percent for the pass this quiz.</small></p>
                    </div>

                    <div class="form-group col-md-4">
                        <label>Questions Limit</label>
                        <input type="number" class="form-control" name="quiz_option[questions_limit]" value="{{$item->option('questions_limit', 10)}}">
                        <p class="text-muted"><small>The number of questions student have to answer in this quiz.</small></p>
                    </div>

                </div>


                <!-- Quiz Save Button -->
                <div class="form-group">
                    <button type="button" class="btn btn-outline-info btn-cancel-form"> {{__t('cancel')}}</button>
                    <button type="submit" class="btn btn-info btn-edit-quiz"  name="save" value="save_next"> <i class="la la-save"></i> {{__t('save_'.$item->item_type)}}</button>
                </div>

            </div>



        </div>



    </form>

</div>








<div id="questionTypesHiddenFormHtml" style="display: none;">
    <!-- Question Type Radio -->
    <div id="quizQuestionWrapType_radio">

        <div class="quiz-question-form-wrap question-type-radio bg-white border p-4">

            <div class="question-basic-info  mb-1 d-flex justify-content-between">
                <div class="question-title">
                    <div class="form-group">
                        <label>Question Title</label>
                        <input type="text" name="question_title" class="form-control" placeholder="write quetion title">
                    </div>
                </div>
                <div class="question-image-wrap">
                    <div class="form-group">
                        <label>Image</label>
                        {!! image_upload_form('image_id') !!}
                    </div>
                </div>

                <div class="question-score">
                    <div class="form-group">
                        <label>Score</label>
                        <input type="number" name="score" class="form-control" placeholder="Score" >
                    </div>
                </div>
            </div>

            <div class="question-options-wrap">
                <div class="question-opt p-2 my-2" data-type="radio">
                    <div class="form-group m-0">

                        <div class="input-group mb-3">
                            <input type="text" class="form-control" name="options[{index}][title]" value="" placeholder="Option title">
                            <div class="input-group-append">
                                <a href="javascript:;" class="input-group-text question-opt-trash"><i class="la la-trash"></i> </a>
                                <a href="javascript:;" class="input-group-text"><i class="la la-sort"></i> </a>
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

    </div>


    <!-- Question Type Text/TextArea -->
    <div id="quizQuestionWrapType_text">
        <div class="quiz-question-form-wrap question-type-radio bg-white border p-4">
            <div class="question-basic-info  mb-1 d-flex justify-content-between">
                <div class="question-title">
                    <div class="form-group">
                        <label>Question Title</label>
                        <input type="text" name="question_title" class="form-control" placeholder="write quetion title">
                    </div>
                </div>
                <div class="question-image-wrap">
                    <div class="form-group">
                        <label>Image</label>
                        {!! image_upload_form('image_id') !!}
                    </div>
                </div>

                <div class="question-score">
                    <div class="form-group">
                        <label>Score</label>
                        <input type="number" name="score" class="form-control" placeholder="Score" >
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>


<!-- Question Form Modal -->
<div class="modal fade" id="quizQuestionTypeMoal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Question Type</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <form action="{{route('create_question', [$item->course_id, $item->id])}}" method="post" id="create-question-form">
                @csrf

                <div class="modal-body">

                    <div class="form-group option-type-selection-wrapper">
                        <input type="radio" id="input_option_type_radio" name="question_type" class="d-none" value="radio">
                        <label class="px-3 py-2" for="input_option_type_radio">
                            <i class="la la-dot-circle"></i> Single Choice
                        </label>

                        <input type="radio" id="input_option_type_checkbox" name="question_type"  class="d-none" value="checkbox">
                        <label class="px-3 py-2" for="input_option_type_checkbox">
                            <i class="la la-check-square"></i> Multiple Choice
                        </label>

                        <input type="radio" id="input_option_type_text" name="question_type" class="d-none" value="text">
                        <label class="px-3 py-2" for="input_option_type_text">
                            <i class="la la-pencil-square"></i> Single Line Text
                        </label>

                        <input type="radio" id="input_option_type_textarea" name="question_type" class="d-none" value="textarea">
                        <label class="px-3 py-2" for="input_option_type_textarea">
                            <i class="la la-file-text"></i> Multi Line Text
                        </label>
                    </div>

                    <div id="questionRequestResponse"></div>

                    <div id="questionTypeFormModal"></div>

                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-purple"><i class="la la-save"></i> Save Question</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </form>

        </div>
    </div>
</div>
<!-- #End Question Form Modal -->
