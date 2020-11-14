@extends('layouts.admin')

@section('page-header-right')
    <a href="{{route('payments')}}" data-toggle="tooltip" title="{{__a('payments')}}"> <i class="la la-arrow-circle-left"></i> {{__a('back_to_payments')}} </a>
@endsection

@section('content')

    <table class="table table-striped table-bordered table-sm">
        @foreach($payment->toArray() as $col_name => $col_value)
            @if(trim($col_value))
                <tr>
                    <th>{{ucwords(str_replace('_', ' ', $col_name))}}</th>
                    <td>
                        @if($col_name === 'status')
                            {!! $payment->status_context !!}
                        @elseif($col_name === 'amount' || $col_name === 'fees_amount' || $col_name === 'total_amount' || $col_name === 'fees_total')
                            {!! price_format($col_value) !!}
                        @elseif($col_name === 'created_at' || $col_name === 'updated_at')
                            {!! date(date_time_format(), strtotime($col_value)) !!}
                        @else
                            {{$col_value}}
                        @endif
                    </td>
                </tr>
            @endif
        @endforeach
    </table>



    <div class="my-4">

        @if($payment->courses->count() > 0)
            <table class="table table-bordered bg-white">

                <tr>
                    <th>{{__t('thumbnail')}}</th>
                    <th>{{__t('title')}}</th>
                    <th>{{__t('price')}}</th>
                    <th>#</th>
                </tr>

                @foreach($payment->courses as $course)
                    <tr>
                        <td>
                            <img src="{{$course->thumbnail_url}}" width="80" />
                        </td>
                        <td>
                            <p class="mb-3">
                                <strong>{{$course->title}}</strong>
                                {!! $course->status_html() !!}
                            </p>

                            <p class="m-0 text-muted">
                                @php
                                    $lectures_count = $course->lectures->count();
                                    $assignments_count = $course->assignments->count();
                                @endphp

                                <span class="course-list-lecture-count">{{$lectures_count}} {{__t('lectures')}}</span>

                                @if($assignments_count)
                                    , <span class="course-list-assignment-count">{{$assignments_count}} {{__t('assignments')}}</span>
                                @endif
                            </p>
                        </td>
                        <td>{!! $course->price_html() !!}</td>

                        <td>

                            @if($course->status == 1)
                                <a href="{{route('course', $course->slug)}}" class="btn btn-sm btn-primary mt-2" target="_blank"><i class="la la-eye"></i> {{__t('view')}} </a>
                            @else
                                <a href="{{route('course', $course->slug)}}" class="btn btn-sm btn-purple mt-2" target="_blank"><i class="la la-eye"></i> {{__t('preview')}} </a>
                            @endif

                        </td>
                    </tr>

                @endforeach
            </table>
        @else
            <div class="no-data-wrap">
                <h3>No course found.</h3>
            </div>
        @endif



    </div>



    <form action="{{route('update_status', $payment->id)}}" class="form-inline" method="post">
        @csrf
        <div class="status-update-form-wrap d-flex p-3 bg-light">
            <span class="mr-2">Update Payment Status</span>

            <select name="status" class="form-control mr-2">
                <option value="">Filter by status</option>
                <option value="initial" {{selected('initial', $payment->status)}} >initial</option>
                <option value="pending" {{selected('pending', $payment->status)}} >pending</option>
                <option value="onhold" {{selected('onhold', $payment->status)}} >onhold</option>
                <option value="success" {{selected('success', $payment->status)}} >success</option>
                <option value="failed" {{selected('failed', $payment->status)}} >failed</option>
                <option value="declined" {{selected('declined', $payment->status)}} >declined</option>
                <option value="dispute" {{selected('dispute', $payment->status)}} >dispute</option>
                <option value="expired" {{selected('expired', $payment->status)}} >expired</option>
            </select>

            <button type="submit" class="btn btn-info mb-2">{{__a('update_status')}}</button>
        </div>
    </form>

@endsection

