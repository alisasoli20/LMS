
<div class="navbar-default sidebar" role="navigation">
    <div id="adminmenuback"></div>
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
            <li>
                <a href="{{route('admin')}}"><i class="la la-dashboard fa-fw"></i> @lang('admin.admin_home')</a>
            </li>

            @php
                do_action('admin_menu_item_before');
            @endphp

            <li>
                <a href="#"><i class="la la-newspaper-o fa-fw"></i> @lang('admin.cms')<span class="la arrow"></span></a>
                <ul class="nav nav-second-level" style="display: none;">
                    <li> <a href="{{ route('posts') }}">@lang('admin.posts')</a> </li>
                    <li> <a href="{{ route('pages') }}">@lang('admin.pages')</a> </li>
                </ul><!-- /.nav-second-level -->
            </li>

            <li>
                <a href="{{route('media_manager')}}"><i class="la la-photo-video"></i> @lang('admin.media_manager')</a>
            </li>

            <li>
                <a href="{{route('category_index')}}"><i class="la la-folder"></i> @lang('admin.categories')</a>
            </li>

            <li>
                <a href="{{route('admin_create_course')}}"><i class="la la-chart-area"></i> {{__a('create_course')}}</a>
            </li>

            <li> <a href="{{route('admin_courses')}}"><i class="la la-chalkboard"></i> {{__a('courses')}}</a>  </li>

            <li>
                <a href="{{route('plugins')}}" class="{{request()->is('admin/plugins*') ? 'active' : ''}}" >
                    <i class="la la-plug"></i> {{__a('plugins')}}
                </a>
            </li>

            <li>
                <a href="{{route('themes')}}" class="{{request()->is('admin/themes*') ? 'active' : ''}}">
                    <i class="la la-brush"></i> {{__a('themes')}}
                </a>
            </li>

            <li>
                <a href="#"><i class="la la-tools fa-fw"></i> @lang('admin.settings')<span class="la arrow"></span></a>
                <ul class="nav nav-second-level" style="display: none;">
                    @php
                        do_action('admin_menu_settings_item_before');
                    @endphp
                    <li> <a href="{{ route('general_settings') }}">@lang('admin.general_settings')</a> </li>
                    <li> <a href="{{ route('lms_settings') }}">@lang('admin.lms_settings')</a> </li>
                    <li> <a href="{{ route('payment_settings') }}">@lang('admin.payment_settings')</a> </li>
                    <li> <a href="{{ route('payment_gateways') }}">@lang('admin.payment_gateways')</a> </li>
                    <li> <a href="{{ route('withdraw_settings') }}">@lang('admin.withdraw')</a> </li>
                    <li> <a href="{{ route('theme_settings') }}">@lang('admin.theme_settings')</a> </li>
                    {{--<li> <a href="{{ route('invoice_settings') }}">@lang('admin.invoice_settings')</a> </li>--}}
                    <li> <a href="{{ route('social_settings') }}"> {{__a('social_login_settings')}} </a> </li>
                    <li> <a href="{{ route('storage_settings') }}"> {{__a('storage')}} </a> </li>
                    @php
                        do_action('admin_menu_settings_item_after');
                    @endphp
                </ul>
                <!-- /.nav-second-level -->
            </li>

            <li> <a href="{{route('payments')}}"><i class="la la-file-invoice-dollar"></i> {{__a('payments')}}</a>  </li>
            <li> <a href="{{route('withdraws')}}"><i class="la la-wallet"></i> {{__a('withdraws')}}</a>  </li>

            <li>
                <a href="#"><i class="la la-users"></i> {{__a('users')}}<span class="la arrow"></span></a>
                <ul class="nav nav-second-level" style="display: none;">
                    <li> <a href="{{ route('users') }}">@lang('admin.instructors')</a> </li>
                    <li> <a href="{{ route('students')}}">@lang('admin.students')</a> </li>
                </ul><!-- /.nav-second-level -->
            </li>

            <li> <a href="{{route('change_password')}}"><i class="la la-lock"></i> @lang('admin.change_password')</a>  </li>

            @php
            do_action('admin_menu_item_after');
            @endphp

            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                    <i class="la la-sign-out"></i> {{__a('logout')}}
                </a>
            </li>

        </ul>
    </div>
    <!-- /.sidebar-collapse -->
</div>
