@extends('layouts.admin')


@section('title-after')
    <a href="{{route('find_plugins')}}" class="btn btn-primary" > <i class="la la-plug"></i> Find new plugins </a>
@endsection

@section('content')

    @php
        $allCount = count($plugins);
        $active_plugins = (array) json_decode(get_option('active_plugins'), true);
        $activeCount = count($active_plugins);
        $inActiveCount = $allCount - $activeCount;
    @endphp

    @if( $allCount)

        <div class="plugins-list-stats">
            <p>
                All ({{count($plugins)}}) | {{__a('active')}} ({{$activeCount}}) | {{__a('inactive')}} ({{$inActiveCount}})
            </p>
        </div>


        <table class="table border plugins-list">

            <thead>
            <tr>
                <th>{{__a('plugin')}}</th>
                <th>{{__a('description')}}</th>
            </tr>
            </thead>

            <tbody>

            @foreach($plugins as $plugin)

                <tr class="plugin-row-{{$plugin->activated ? 'activated' : 'deactivated'}}">
                    <td>
                        <p class="plugin-name">{{$plugin->name}}</p>

                        <p class="mb-0">
                            @if($plugin->activated)
                                <a class="activate-link" href="{{route('plugin_action', ['action' => 'deactivate', 'plugin' => $plugin->basename])}}">{{__a('deactivate')}}</a>
                            @else
                                <a class="activate-link" href="{{route('plugin_action', ['action' => 'activate', 'plugin' => $plugin->basename])}}">{{__a('activate')}}</a>
                            @endif
                        </p>

                    </td>
                    <td>

                        <div class="plugin-details">
                            <p>{{$plugin->description}}</p>

                            <p class="mb-0 font-weight-bold">{{__a('version')}} : {{$plugin->version}} | By
                                @if($plugin->author_url)
                                    <a href="{{$plugin->author_url}}" target="_blank">
                                        @endif
                                        @if($plugin->author)
                                            {!! $plugin->author !!}
                                        @endif
                                        @if($plugin->author_url)
                                    </a>
                                @endif

                                @if($plugin->url)
                                    | <a href="{{$plugin->url}}" target="_blank"> {{__a('view_details')}} </a>
                                @endif
                            </p>
                        </div>

                    </td>
                </tr>

            @endforeach

            </tbody>


        </table>

    @else

        <div class="alert alert-light bg-light d-flex">
            <div class="mr-3">
                <span class="no-plugin-icon"><i class="la la-info-circle"></i></span>
            </div>
            <div>
                <h4> No available plugins</h4>
                <p class="mb-0">Plugins extend and expand the functionality of Teachify LMS. Checkout below plugins and consider using these plugins to take your application to the next level.</p>
            </div>
        </div>

        @if(is_array($extended_plugins) && count($extended_plugins))
            <div class="extended-plugins find-plugins-lists">
                <div class="row">
                    @foreach($extended_plugins as $extended_plugin)
                        @php
                            $name = array_get($extended_plugin, 'name');
                            $desc = array_get($extended_plugin, 'desc');
                            $version = array_get($extended_plugin, 'version');
                            $release_date = array_get($extended_plugin, 'release_date');
                            $url = array_get($extended_plugin, 'url');
                            $thumbnail_url = array_get($extended_plugin, 'thumbnail_url');
                        @endphp
                        <div class="col-md-4 mb-3">
                            <div class="card">
                                @if($thumbnail_url)
                                    <a href="{{$url}}" target="_blank">
                                        <img class="card-img-top" src="{{$thumbnail_url}}" alt="Card image cap">
                                    </a>
                                @endif

                                <div class="card-body">
                                    <a href="{{$url}}" target="_blank" class="plugin-name"> <h5 class="card-title">{{$name}}</h5> </a>
                                    <p class="card-text">{{$desc}}</p>
                                    <a href="{{$url}}" target="_blank" class="btn btn-dark-blue" >View Details</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif


    @endif

@endsection
