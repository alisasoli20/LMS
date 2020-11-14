@extends('layouts.admin')

@section('content')


    @php
    $userCount = \App\User::count();
    $totalInstructors = \App\User::whereUserType('instructor')->count();
    $totalStudents = \App\User::whereUserType('student')->count();
    $courseCount = \App\Course::publish()->count();
    $lectureCount = \App\Content::whereItemType('lecture')->count();
    $quizCount = \App\Content::whereItemType('quiz')->count();
    $assignmentCount = \App\Content::whereItemType('assignment')->count();
    $questionCount = \App\Discussion::whereDiscussionId(0)->count();
    $totalEnrol = \App\Enroll::whereStatus('success')->count();
    $totalReview = \App\Review::count();
    $totalAmount = \App\Payment::whereStatus('success')->sum('amount');
    $withdrawsTotal = \App\Withdraw::whereStatus('approved')->sum('amount');

    $payments = \App\Payment::query()->orderBy('id', 'desc')->take(20)->get();

    @endphp

    <div class="row">

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-user"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{$userCount}}</h4></div>
                    <div>Users</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-chalkboard-teacher"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{$totalInstructors}}</h4></div>
                    <div>Instructors</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-user-graduate"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{$totalStudents}}</h4></div>
                    <div>Students</div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-graduation-cap"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{$courseCount}}</h4></div>
                    <div>Course</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-play"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{$lectureCount}}</h4></div>
                    <div>Lecture</div>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-clipboard-list"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{$quizCount}}</h4></div>
                    <div>Quiz</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-check-circle"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{$assignmentCount}}</h4></div>
                    <div>Assignments</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-question-circle"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{$questionCount}}</h4></div>
                    <div>Question Asked</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-sign-in"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{$totalEnrol}}</h4></div>
                    <div>Enrolled</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-star-half-alt"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{{$totalReview}}</h4></div>
                    <div>Reviews</div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-money"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{!! price_format($totalAmount) !!}</h4></div>
                    <div>Payment Total</div>
                </div>
            </div>
        </div>


        <div class="col-lg-3 col-md-6">
            <div class="dashboard-card mb-3 d-flex border p-3 bg-light">
                <div class="card-icon mr-2">
                    <span><i class="la la-sign-out"></i> </span>
                </div>

                <div class="card-info">
                    <div class="text-value"><h4>{!! price_format($withdrawsTotal) !!}</h4></div>
                    <div>Withdraws Total</div>
                </div>
            </div>
        </div>

    </div>


    <div class="p-4 bg-white">
        <h4 class="mb-4">Payments graph for the month of <strong>{{date('M')}}</strong> </h4>

        <canvas id="ChartArea"></canvas>
    </div>


    @if($payments->count() > 0)
        <h4 class="my-4"> Last {{$payments->count()}} {{__a('payments')}}</h4>

        <table class="table table-striped table-bordered">

            <tr>
                <th>{{__a('paid_by')}}</th>
                <th>{{__a('amount')}}</th>
                <th>{{__a('method')}}</th>
                <th>{{__a('time')}}</th>
                <th>{{__a('status')}}</th>
                <th>#</th>
            </tr>

            @foreach($payments as $payment)
                <tr>
                    <td>
                        <a href="{!!route('payment_view', $payment->id)!!}">
                            {!!$payment->name!!} <br />
                            <small>{!!$payment->email!!}</small>
                        </a>
                    </td>

                    <td>
                        {!!price_format($payment->amount)!!}
                    </td>
                    <td>{!!ucwords(str_replace('_', ' ', $payment->payment_method))!!}</td>

                    <td>
                        <small>
                            {!!$payment->created_at->format(get_option('date_format'))!!} <br />
                            {!!$payment->created_at->format(get_option('time_format'))!!}
                        </small>
                    </td>

                    <td>
                        {!! $payment->status_context !!}
                    </td>
                    <td>
                        @if($payment->status == 'success')
                            <span class="text-success" data-toggle="tooltip" title="{!!$payment->status!!}"><i class="fa fa-check-circle-o"></i> </span>
                        @else
                            <span class="text-warning" data-toggle="tooltip" title="{!!$payment->status!!}"><i class="fa fa-exclamation-circle"></i> </span>
                        @endif

                        <a href="{!!route('payment_view', $payment->id)!!}" class="btn btn-info"><i class="la la-eye"></i> </a>
                    </td>

                </tr>
            @endforeach

        </table>

    @else
        {!! no_data() !!}
    @endif


@endsection



@section('page-js')
    <script src="{{asset('assets/plugins/chartjs/Chart.min.js')}}"></script>

    <script>
        var ctx = document.getElementById("ChartArea").getContext('2d');
        var ChartArea = new Chart(ctx, {
            type: 'line',
            data: {
                labels: {!! json_encode(array_keys($chartData)) !!},
                datasets: [{
                    label: 'Earning ',
                    backgroundColor: '#216094',
                    borderColor: '#216094',
                    data: {!! json_encode(array_values($chartData)) !!},
                    borderWidth: 2,
                    fill: false,
                    lineTension: 0,
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            min: 0, // it is for ignoring negative step.
                            beginAtZero: true,
                            callback: function(value, index, values) {
                                return '{{get_currency()}} ' + value;
                            }
                        }
                    }]
                },
                tooltips: {
                    callbacks: {
                        label: function(t, d) {
                            var xLabel = d.datasets[t.datasetIndex].label;
                            var yLabel = t.yLabel >= 1000 ? '$' + t.yLabel.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") : '{{get_currency()}} ' + t.yLabel;
                            return xLabel + ': ' + yLabel;
                        }
                    }
                },
                legend: {
                    display: false
                }
            }
        });
    </script>

@endsection
