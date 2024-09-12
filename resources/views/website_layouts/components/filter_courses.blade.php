@if (!Route::is(['student.courses', 'course-list']))
    <!-- Filter -->
    <div class="showing-list">
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex align-items-center">
                    <div class="view-icons">
                        @if (!Route::is(['students-grid', 'students-grid2', 'students-list']))
                            <a href="{{ url('instructor-grid') }}"
                               class="grid-view {{ Request::is('instructor-grid') ? 'active' : '' }}"><i
                                    class="feather-grid"></i></a>
                            <a href="{{ url('instructor-list') }}"
                               class="list-view {{ Request::is('instructor-list') ? 'active' : '' }}"><i
                                    class="feather-list"></i></a>
                        @endif
                        @if (Route::is(['students-grid', 'students-grid2', 'students-list']))
                            <a href="{{ url('students-grid') }}"
                               class="grid-view {{ Request::is('students-grid', 'students-grid2') ? 'active' : '' }}"><i
                                    class="feather-grid"></i></a>
                            <a href="{{ url('students-list') }}"
                               class="list-view {{ Request::is('students-list') ? 'active' : '' }}"><i
                                    class="feather-list"></i></a>
                        @endif
                    </div>
                    <div class="show-result">
                        <h4>Showing 1-9 of 50 results</h4>
                    </div>
                </div>
            </div>
            @if (!Route::is(['students-grid', 'students-grid', 'students-list']))
                <div class="col-lg-6">
                    <div class="show-filter add-course-info">
                        <form action="#">
                            <div class="row gx-2 align-items-center">
                                <div class="col-md-6 col-item">
                                    <div class=" search-group">
                                        <i class="feather-search"></i>
                                        <input type="text" class="form-control" placeholder="Search our courses">
                                    </div>
                                </div>
                                <div class="col-md-6 col-lg-6 col-item">
                                    <div class="input-block select-form mb-0">
                                        @livewire('select2-component-filter')
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
    <!-- /Filter -->
@endif
@if (Route::is(['student.courses', 'course-list']))
    <!-- Filter -->
    <div class="showing-list">
        <div class="row">
            <div class="col-lg-6">
                <div class="d-flex align-items-center">
                    <div class="view-icons">
{{--                        <a href="{{ route('student.courses', ["curriculum_id" => request("curriculum_id")]) }}"--}}
{{--                           class="grid-view {{ Route::is('student.courses') ? 'active' : '' }}"><i--}}
{{--                                class="feather-grid"></i></a>--}}
{{--                        <a href="{{ url('course-list') }}"--}}
{{--                           class="list-view {{ Request::is('course-list') ? 'active' : '' }}"><i--}}
{{--                                class="feather-list"></i></a>--}}
                    </div>
                    <div class="show-result">
                        <h4>Showing {{ $result }}-{{ $perPage }} of {{ $total }} results</h4>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="show-filter add-course-info">
                    <form action="#">
                        <div class="row gx-2 align-items-center">
                            <div class="col-md-12 col-lg-12 col-item">
                                <div class="input-block select-form mb-0">
                                    <select class="form-select select" id="sel1" name="sellist1" onchange="window.location = this.value">
                                        <option value="{{ route("student.courses", ["curriculum_id" => request("curriculum_id"), "filter" => "newest"]) }}"
                                            {{ request("filter") == "newest" ? "selected" : ""}}>{{ __("lang.newest") }}</option>
                                        <option value="{{ route("student.courses", ["curriculum_id" => request("curriculum_id"), "filter" => "oldest"]) }}"
                                            {{ request("filter") == "oldest" ? "selected" : ""}}>{{ __("lang.oldest") }}</option>
                                        <option value="{{ route("student.courses", ["curriculum_id" => request("curriculum_id"), "filter" => "price_high"]) }}"
                                            {{ request("filter") == "price_high" ? "selected" : ""}}>{{ __("lang.price_high") }}</option>
                                        <option value="{{ route("student.courses", ["curriculum_id" => request("curriculum_id"), "filter" => "price_low"]) }}"
                                            {{ request("filter") == "price_low" ? "selected" : ""}}>{{ __("lang.price_low") }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- /Filter -->
@endif
