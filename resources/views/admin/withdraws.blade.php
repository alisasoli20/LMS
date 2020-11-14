@extends('layouts.admin')


@section('page-header-right')

    <a href="{{route('withdraws')}}" class="btn btn-dark ml-2" > <i class="la la-clock-o"></i> Pending</a>
    <a href="{{route('withdraws', ['status' => 'success'])}}" class="btn btn-success ml-2" > <i class="la la-check-circle"></i> Success</a>
    <a href="{{route('withdraws', ['status' => 'rejected'])}}" class="btn btn-warning ml-2" > <i class="la la-exclamation-circle"></i> Rejected</a>
    <a href="{{route('withdraws', ['status' => 'all'])}}" class="btn btn-light ml-2" > <i class="la la-th-list"></i> All</a>

@endsection

@section('content')

    <div class="withdraws-list-wrap">

        <form action="" method="get">


            @if($withdraws->count() > 0)

                <div class="row">

                    <div class="col-md-5">
                        <div class="input-group">
                            <select name="update_status" class="mr-3">
                                <option value="">{{__a('set_status')}}</option>

                                <option value="pending">Pending</option>
                                <option value="approved">Approve</option>
                                <option value="rejected">Reject</option>
                            </select>

                            <button type="submit" name="bulk_action_btn" value="update_status" class="btn btn-primary mr-2">{{__a('update')}}</button>
                            <button type="submit" name="bulk_action_btn" value="delete" class="btn btn-danger delete_confirm"> <i class="la la-trash"></i> {{__a('delete')}}</button>
                        </div>
                    </div>
                </div>



                <p class="text-muted my-3"> <small>Showing {{$withdraws->count()}} from {{$withdraws->total()}} results</small> </p>



                <table class="table table-bordered table-striped">
                    <tr>
                        <th><input class="bulk_check_all" type="checkbox" /></th>
                        <th>{{__a('amount')}}</th>
                        <th>{{__a('details')}}</th>
                        <th>{{__a('time')}}</th>
                    </tr>

                    @foreach($withdraws as $withdraw)

                        <tr>

                            <td>
                                <label>
                                    <input class="check_bulk_item" name="bulk_ids[]" type="checkbox" value="{{$withdraw->id}}" />
                                    <small class="text-muted">#{{$withdraw->id}}</small>
                                </label>
                            </td>
                            <td>
                                <h6 class="mb-4">Amount: <strong>{!! price_format($withdraw->amount) !!}</strong> {!! $withdraw->status_context !!} </h6>
                                <h6>Method: <strong>{{array_get($withdraw->method_data, 'method_name')}}</strong></h6>


                            </td>

                            <td>

                                @if(is_array(array_get($withdraw->method_data, 'form_fields')))
                                    @foreach(array_get($withdraw->method_data, 'form_fields') as $field)
                                        <p class="mb-0"> {{array_get($field, 'label')}} : <strong>{!! array_get($field, 'value') !!}</strong></p>
                                    @endforeach
                                @endif

                                {{clean_html($withdraw->description)}}

                            </td>

                            <td>{{$withdraw->created_at->format(date_time_format())}}</td>
                        </tr>

                    @endforeach

                </table>


                {!! $withdraws->appends(request()->input())->links() !!}

            @else
                {!! no_data() !!}
            @endif

        </form>



    </div>


@endsection
