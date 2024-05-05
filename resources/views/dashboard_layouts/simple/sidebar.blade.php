<div class="sidebar-wrapper">
	<div>
		<div class="logo-wrapper">
			<a href="{{route('admin.dashboard')}}"><img class="img-fluid for-light" src="{{asset('assets/images/logo/logo.png')}}" alt=""><img class="img-fluid for-dark" src="{{asset('assets/images/logo/logo_dark.png')}}" alt=""></a>
			<div class="back-btn"><i class="fa fa-angle-left"></i></div>
			<div class="toggle-sidebar"><i class="status_toggle middle sidebar-toggle" data-feather="grid"> </i></div>
		</div>
		<div class="logo-icon-wrapper"><a href="{{route('admin.dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a></div>
		<nav class="sidebar-main">
			<div class="left-arrow" id="left-arrow"><i data-feather="arrow-left"></i></div>
			<div id="sidebar-menu">
				<ul class="sidebar-links" id="simple-bar">
					<li class="back-btn">
						<a href="{{route('admin.dashboard')}}"><img class="img-fluid" src="{{asset('assets/images/logo/logo-icon.png')}}" alt=""></a>
						<div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
					</li>
                    @if(isset(session("admin_data")["permission"]))
                        @foreach(session("admin_data")["permission"]["permissions"] as $route)
                            @php $items = $route["items"] @endphp

{{--                                <li class="sidebar-main-title">--}}
{{--                                    <div>--}}
{{--                                        <h6 class="lan-1">{{ $route["title"]["translate"] }}</h6>--}}
{{--                                        <p class="lan-2">{{ trans('lang.Dashboards,widgets & layout.') }}</p>--}}
{{--                                    </div>--}}
{{--                                </li>--}}
                                <li class="sidebar-list">
                                    @php
                                        $request_path = request()->path();
                                        $activeMenu = in_array("api/".$request_path, array_column($items, "link"));
                                    @endphp
                                    <a class="sidebar-link sidebar-title" href="#">
                                        <i data-feather="settings"></i>
                                        <span class="lan-7">{{ $route["title"]["translates"][app()->getLocale()] }}</span>
                                        <div class="according-menu"><i class="fa fa-angle-{{ $activeMenu ? "down" : "right" }}"></i></div>
                                    </a>
                                    <ul class="sidebar-submenu" style="display:{{ $activeMenu ? "block" : "none" }}">
                                        @foreach($items as $item)
                                            <li><a href="{{url(str_replace("api/", "", $item["link"]))}}" class="{{"api/$request_path" === $item["link"] ? 'active' : ''}}"><i data-feather="settings"></i>{{ $item["title"]["translates"][app()->getLocale()] }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                        @endforeach
                    @endif
                </ul>
			</div>
			<div class="right-arrow" id="right-arrow"><i data-feather="arrow-right"></i></div>
		</nav>
	</div>
</div>

