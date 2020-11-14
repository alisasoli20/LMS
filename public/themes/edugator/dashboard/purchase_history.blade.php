@extends(theme('dashboard.layout'))

@section('content')

    @php
        $purchases = $auth_user->purchases()->paginate(50);
    @endphp

    @if($purchases->count() > 0)
        <p class="text-muted my-3"> <small>Showing {{$purchases->count()}} from {{$purchases->total()}} results</small> </p>

        <table class="table table-striped table-bordered">

            <tr>
                <th>#</th>
                <th>{{__a('amount')}}</th>
                <th>{{__a('method')}}</th>
                <th>{{__a('time')}}</th>
                <th>{{__a('status')}}</th>
                <th>#</th>
            </tr>

            @foreach($purchases as $purchase)
                <tr>
                    <td>
                        <small class="text-muted">#{{$purchase->id}}</small>
                    </td>
                    <td>
                        {!!price_format($purchase->amount)!!}
                    </td>
                    <td>{!!ucwords(str_replace('_', ' ', $purchase->payment_method))!!}</td>

                    <td>
                        <small>
                            {!!$purchase->created_at->format(get_option('date_format'))!!} <br />
                            {!!$purchase->created_at->format(get_option('time_format'))!!}
                        </small>
                    </td>

                    <td>
                        {!! $purchase->status_context !!}
                    </td>
                    <td>
                        @if($purchase->status == 'success')
                            <span class="text-success" data-toggle="tooltip" title="{!!$purchase->status!!}"><i class="fa fa-check-circle-o"></i> </span>
                        @else
                            <span class="text-warning" data-toggle="tooltip" title="{!!$purchase->status!!}"><i class="fa fa-exclamation-circle"></i> </span>
                        @endif

                        <a href="{!!route('purchase_view', $purchase->id)!!}" class="btn btn-info"><i class="la la-eye"></i> </a>
                    </td>

                </tr>
            @endforeach

        </table>

        {!! $purchases->appends(request()->input())->links() !!}

    @else
        {!! no_data() !!}
    @endif




@endsection
