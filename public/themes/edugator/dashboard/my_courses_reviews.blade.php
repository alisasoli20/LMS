@extends(theme('dashboard.layout'))

@section('content')

    @php
    $reviews = $auth_user->get_reviews()->with('course', 'user', 'user.photo_query')->orderBy('created_at', 'desc')->paginate(20);
    @endphp

    @if($reviews->total())

        <p class="text-muted mb-3"> Showing {{$reviews->count()}} from {{$reviews->total()}} results </p>


        @foreach($reviews as $review)
            <div class="my-review p-4 mb-3 bg-white border">

                <div class="d-flex mb-3">


                    <div class="reviewed-user-photo">
                        <a href="{{route('profile', $review->user_id)}}">
                            {!! $review->user->get_photo !!}
                        </a>
                    </div>

                    <div class="reviewed-user-detail">

                        <a href="{{route('profile', $review->user_id)}}" class="mb-2 d-block">
                            {!! $review->user->name !!}
                        </a>

                        <div class="d-flex">
                            {!! star_rating_generator($review->rating) !!}
                            <span class="ml-2">({{$review->rating}})</span>
                            <a href="{{route('review', $review->id)}}" class="text-muted d-block ml-3" >{{$review->created_at->diffForHumans()}}</a>
                        </div>

                    </div>

                </div>


                <h4><a href="{{route('course', $review->course->id)}}" class="mb-3 d-block">{{$review->course->title}}</a></h4>

                @if($review->review)
                    <div class="review-desc mt-3">
                        {!! nl2br($review->review) !!}
                    </div>
                @endif
            </div>
        @endforeach

        {!! $reviews->links(); !!}
    @else
        {!! no_data(null, null, 'my-5' ) !!}
    @endif

@endsection
