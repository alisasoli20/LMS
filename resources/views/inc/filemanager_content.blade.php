<div id="filemanager" class="modal-dialog">
    <div class="modal-content">
        <div class="modal-body">
            <div class="row">
                <div class="col-sm-4">

                    <a href="{{route('load_filemanager')}}" data-toggle="tooltip" title="" id="button-refresh" class="btn btn-default" data-original-title="Refresh"><i class="la la-refresh"></i></a>

                    <button type="button" data-toggle="tooltip" title="Upload" id="button-upload" class="btn btn-primary"><i class="la la-upload"></i></button>
                    <button type="button" data-toggle="tooltip" title="Insert Media" class="btn btn-info mediaInsertBtn"><i class="la la-plus-circle"></i></button>
                    <button type="button" data-toggle="tooltip" title="Delete" id="button-delete" class="btn btn-danger"><i class="la la-trash-o"></i></button>
                </div>

                <div class="col-sm-7">
                    <div class="input-group">
                        <input type="text" name="filemanager-search" value="{{request('filter_name')}}" placeholder="Search.." class="form-control">
                        <span class="input-group-btn">
                            <button type="button" data-toggle="tooltip" title="Search" id="button-search" class="btn btn-primary">
                                <i class="la la-search"></i>
                            </button>
                        </span>
                    </div>
                </div>

                <div class="col-sm-1">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>

            </div>

            <div class="row mt-2 mb-0">
                <div class="col-sm-12">
                    <p class="mb-0 allowed_file_text"> @lang('admin.allowed_file_types') :
                        <code>{{get_option('allowed_file_types')}}</code>
                    </p>
                </div>
            </div>

            <hr class="mb-0" />
            <div class="row">
                <div class="col-md-12">
                    <div id="statusMsg"></div>
                </div>
            </div>

            <div class="media-modal-wrap d-flex">

                <div class="media-modal-thumbnail-wrap flex-grow-1 pt-3">

                    @if($medias->count())
                        <div class="media-manager-grid-wrap">
                            @foreach($medias as $media)
                                <div id="media-grid-id-{{$media->id}}" class="media-manager-single-grid">
                                    <a href="javascript:;" class="media-modal-thumbnail" data-media-info="{{json_encode($media->media_info)}}" >
                                        <img src="{{$media->thumbnail}}" alt="{{$media->name}}" title="{{$media->name}}" />
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="media-modal-info-wrap bg-light p-3">

                    <div class="adminMediaModalInfoSide">
                        <p id="mediaModalFileID" class="m-1"><strong>ID:</strong> #<span></span></p>
                        <p id="mediaModalFileName" class="m-1"><strong>File name:</strong> <span></span></p>
                        <p id="mediaModalFileType" class="m-1"><strong>File Type:</strong> <span></span></p>
                        <p id="mediaModalFileUploadedOn" class="m-1"><strong>Uploaded on:</strong> <span></span></p>
                        <p id="mediaModalFileSize" class="m-1"><strong>File Size:</strong> <span></span></p>
                    </div>

                    <hr />
                    <img id="mediaManagerPreviewScreen" src="{{asset('uploads/placeholder-image.png')}}" class="mediaManagerPreviewScreen img-fluid" />
                    <hr />

                    <form id="adminMediaManagerModalForm" method="post"> @csrf
                        <input type="hidden" id="sc_modal_info_media_id" name="media_id" value="">
                        <div class="form-group row">
                            <label for="mediaFileTitle" class="col-sm-4 col-form-label col-form-label-sm text-right">Title</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="title" id="mediaFileTitle">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="mediaFileAltText" class="col-sm-4 col-form-label col-form-label-sm text-right">Alt Text</label>
                            <div class="col-sm-8">
                                <input type="text" class="form-control form-control-sm" name="alt_text" id="mediaFileAltText">

                                <div id="formWorkingIconWrap" class="my-3"></div>
                            </div>
                        </div>

                    </form>

                    <hr />

                    <button type="button" class="btn btn-info mediaInsertBtn">
                        <i class="la la-plus-circle"></i> {{__a('insert_selected_media')}}
                    </button>

                </div>

            </div>

            <br />
        </div>
        <div class="modal-footer filemanager-pagination-wrap">
            {!! $medias->appends(['filter_name' => request('filter_name')])->links() !!}
        </div>
    </div>
</div>
