@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('category_index')}}" class="ml-1 btn btn-secondary btn-xl" data-toggle="tooltip" title="@lang('admin.categories')"> <i class="la la-folder-open"></i> </a>

    <a href="{{route('category_create')}}" class="ml-1 btn btn-primary btn-xl" data-toggle="tooltip" title="@lang('admin.category_add')"> <i class="la la-plus"></i> </a>

    <button type="submit" form="form-category" class="ml-1 btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')"> <i class="la la-save"></i> </button>
@endsection

@section('content')

    <div class="row">
        <div class="col-md-12">

            <form action="" id="form-category" method="post" enctype="multipart/form-data"> @csrf

                <div class="form-group row {{ $errors->has('category_name')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="category_name">@lang('admin.category_name')</label>
                    <div class="col-sm-7">
                        <input type="text" name="category_name" value="{{$category->category_name}}" placeholder="@lang('admin.category_name')" id="category_name" class="form-control">
                        {!! $errors->has('category_name')? '<p class="help-block">'.$errors->first('category_name').'</p>':'' !!}
                    </div>
                </div>

                <div class="form-group row {{ $errors->has('parent')? 'has-error':'' }} ">
                    <label class="col-sm-3 control-label" for="parent">@lang('admin.parent')</label>
                    <div class="col-sm-7">
                        <select name="parent" id="parent" class="form-control select2">
                            <option value="0">@lang('admin.select_category')</option>
                            @if($categories->count() > 0)
                                @foreach($categories as $parent)
                                    <option value="{{$parent->id}}" {{selected($category->category_id, $parent->id)}} > {{$parent->category_name }} </option>

                                    @foreach($parent->sub_categories as $subCategory)
                                        <option value="{{$subCategory->id}}" {{selected($category->category_id, $subCategory->id)}} > &nbsp;&nbsp;&nbsp; &raquo; {!! $subCategory->category_name !!} </option>
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
                                <option value="{{$icon}}" {{selected($icon, $category->icon_class)}} data-icon="{{$icon}}">{{$icon}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group row">
                    <label class="col-sm-3 control-label">@lang('admin.status')</label>
                    <div class="col-sm-7">
                        <label><input type="radio" name="status" value="1" @if($category->status == 1)checked="checked" @endif> {{__('admin.publish')}}</label> <br />
                        <label><input type="radio" name="status" value="0"  @if($category->status == 0)checked="checked" @endif> {{__('admin.unpublish')}}</label>
                    </div>
                </div>



                <div class="form-group row">
                    <div class="col-sm-7 offset-3">
                        <button type="submit" form="form-category" class="btn btn-success btn-xl" data-toggle="tooltip" title="@lang('admin.save')"> <i class="la la-save"></i> {{__a('save')}} </button>
                    </div>
                </div>

            </form>


        </div>


    </div>



@endsection
