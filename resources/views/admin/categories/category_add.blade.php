@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('category_index')}}" class="btn btn-secondary btn-xl mr-1" data-toggle="tooltip" title="@lang('admin.categories')"> <i class="la la-folder-open"></i> </a>

    <button type="submit" form="form-category" class="btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')"> <i class="la la-save"></i> </button>
@endsection

@section('content')

    <form action="" id="form-category" method="post" enctype="multipart/form-data"> @csrf

        <div class="row">

            <div class="col-md-12">

                <div class="form-group row {{ $errors->has('category_name')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="category_name">@lang('admin.category_name')</label>
                    <div class="col-sm-7">
                        <input type="text" name="category_name" value="" placeholder="@lang('admin.category_name')" id="category_name" class="form-control">
                        {!! $errors->has('category_name')? '<p class="help-block">'.$errors->first('category_name').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('parent')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="parent">@lang('admin.parent')</label>
                    <div class="col-sm-7">
                        <select name="parent" id="parent" class="form-control select2">
                            <option value="0">@lang('admin.select_category')</option>
                            @if($categories->count() > 0)
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}"> {!! $category->category_name !!} </option>
                                    @foreach($category->sub_categories as $subCategory)
                                        <option value="{{$subCategory->id}}"> &nbsp;&nbsp;&nbsp; &raquo; {!! $subCategory->category_name !!} </option>
                                    @endforeach
                                @endforeach
                            @endif
                        </select>

                        {!! $errors->has('parent')? '<p class="help-block">'.$errors->first('parent').'</p>':'' !!}
                    </div>
                </div>


                <div class="form-group row">
                    <label class="col-sm-3 control-label">{{__a('select_icon')}}</label>
                    <div class="col-sm-7">
                        <select class="form-control select2icon" name="icon_class">
                            <option value="0">{{__a('select_icon')}}</option>
                            @foreach(icon_classes() as $icon => $val)
                                <option value="{{ $icon }}" data-icon="{{ $icon }}">{{ $icon }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label" for="description">@lang('admin.status')</label>
                    <div class="col-sm-7">
                        <label><input type="radio" name="status" value="1" checked="checked"> {{__a('publish')}}</label> <br />
                        <label><input type="radio" name="status" value="0"> {{__a('unpublish')}}</label>
                    </div>
                </div>

                <div class="form-group row">
                    <div class="col-sm-7 offset-3">
                        <button type="submit" form="form-category" class="btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')"> <i class="la la-save"></i> {{__a('save')}} </button>
                    </div>
                </div>


            </div>

        </div>

    </form>

@endsection
