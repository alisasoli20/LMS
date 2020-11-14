@extends('layouts.admin')

@section('content')

    <form method="get">


        <div class="row">

            <div class="col-md-5">
                <div class="input-group">
                    <select name="status" class="mr-3">
                        <option value="">{{__a('set_status')}}</option>

                        <option value="1">Active</option>
                        <option value="2">Block</option>
                    </select>

                    <button type="submit" name="bulk_action_btn" value="update_status" class="btn btn-primary mr-2">{{__a('update')}}</button>
                    <button type="submit" name="bulk_action_btn" value="delete" class="btn btn-danger delete_confirm mr-2"> <i class="la la-trash"></i> {{__a('delete')}}</button>
                    <a href="{{ route('add_administrator') }}" class="btn btn-success text-white" data-toggle="tooltip" title="{{__a('create_instructor')}}"><i class="la la-plus-circle"></i> {{ __a('create_instructor') }}</a>
                </div>
            </div>

            <div class="col-md-7">

                <div class="search-filter-form-wrap mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control mr-3" name="q" value="{{request('q')}}" placeholder="Filter by Name, E-Mail">
                        <select name="filter_status" class="mr-3">
                            <option value="">Status</option>
                            <option value="1" {{selected(1, request('filter_status'))}} > Active </option>
                            <option value="2" {{selected(2, request('filter_status'))}} > Blocked </option>
                        </select>
                        <select name="filter_user_group" class="mr-3">
                            <option value="">User Group</option>
                            <option value="student" {{selected('student', request('filter_user_group'))}} > Students </option>
                            <option value="instructor" {{selected('instructor', request('filter_user_group'))}} > Instructor </option>
                            <option value="admin" {{selected('admin', request('filter_user_group'))}} > Admin </option>

                        </select>

                        <button type="submit" class="btn btn-primary btn-purple"><i class="la la-search-plus"></i> Filter results</button>
                    </div>
                </div>
            </div>

        </div>


        @if($users->total())

            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered table-striped">
                        <tr>
                            <th><input class="bulk_check_all" type="checkbox" /></th>
                            <th>{{ trans('admin.name') }}</th>
                            <th>{{ trans('admin.email') }}</th>
                            <th>{{__a('type')}}</th>
                            <th>{{__a('edit')}}</th>
                        </tr>
                        @foreach($users as $u)
                            <tr>
                                <td>
                                    <label>
                                        <input class="check_bulk_item" name="bulk_ids[]" type="checkbox" value="{{$u->id}}" />
                                        <small class="text-muted">#{{$u->id}}</small>
                                    </label>
                                </td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>

                                    @if($u->isAdmin)
                                        <span class="badge badge-success">Admin</span>
                                    @elseif($u->isInstructor)
                                        <span class="badge badge-info">Instructor</span>
                                    @else
                                        <span class="badge badge-dark">Student</span>
                                    @endif

                                    @if($u->active_status == 2)
                                        <span class="badge badge-danger">Blocked</span>
                                    @endif
                                </td>
                                <td><a href="{{ route('edit_administrator',$u->id) }}" ><i class="la la-edit text-info la-1x"></i></a></td>
                            </tr>
                        @endforeach
                    </table>


                    {!! $users->appends(request()->input())->links() !!}

                </div>
            </div>

        @else
            {!! no_data() !!}
        @endif

    </form>

@endsection
