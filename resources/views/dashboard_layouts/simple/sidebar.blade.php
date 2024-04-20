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

                                <li class="sidebar-main-title">
                                    <div>
                                        <h6 class="lan-1">{{ $route["title"]["translate"] }}</h6>
                                        <p class="lan-2">{{ trans('lang.Dashboards,widgets & layout.') }}</p>
                                    </div>
                                </li>
                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title" href="#">
                                        <i data-feather="home"></i>
                                        <span class="lan-7">{{ $route["title"]["translate"] }}</span>
                                        <div class="according-menu"><i class="fa fa-angle-down"></i></div>
                                    </a>
                                    <ul class="sidebar-submenu" style="display:block">
                                        @foreach($items as $item)
                                            @php
                                                $item["route_title"] = $route["title"]["translate"];
                                                $item_data = json_encode($item);
                                                $active = '';
                                                $request_path = request()->path();
                                                if ("api/$request_path" === $item["link"]) $active = 'active';
                                            @endphp

                                            <li><a href="#" onclick="setPageDataToSession('{{$item_data}}')" class="{{$active}}">{{ $item["title"]["translate"] }}</a></li>

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
<script>
    function setPageDataToSession(pageData) {
        let url = "{{ url('') }}";

        $.ajax({
            url: "http://127.0.0.1:8000/admin/addTo/session",
            type: "POST",
            data: JSON.stringify({"page_data": JSON.parse(pageData)}),
            processData: false,
            contentType: "application/json",
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            success: function(response) {
                let uri = url + JSON.parse(pageData).link
                uri = uri.replace(new RegExp('api', 'g'), '');
                window.location = uri;
            },
            error: function(xhr, status, error) {
                let title = "Some thing went wrong";
                let message = xhr.responseText || "Unknown error";
                notifyForm(title, message, "danger");
            }
        });
    }
</script>
