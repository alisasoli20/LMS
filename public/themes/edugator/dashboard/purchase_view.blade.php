@extends(theme('dashboard.layout'))

@section('content')

    <div class="purchase-ful-view-wrap p-4 bg-white">

        <h4 class="mb-4">Purchase Details</h4>

        <table class="table table-striped table-bordered table-sm">

            @php
            $cols = $payment->toArray();
            unset($cols['user_id'])

            @endphp

            @foreach($cols as $col_name => $col_value)
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

    </div>


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




@endsection
