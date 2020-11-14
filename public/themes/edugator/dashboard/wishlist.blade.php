@extends(theme('dashboard.layout'))

@section('content')

    @php
        $courses = $auth_user->wishlist()->publish()->get();
    @endphp

    @if($courses->count())
        <div class="row">
            @foreach($courses as $course)
                {!! course_card($course, 'col-md-4') !!}
            @endforeach
        </div>
    @else
        {!! no_data(null, null, 'my-5' ) !!}
    @endif

@endsection
