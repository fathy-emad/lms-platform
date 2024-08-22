@extends('website_layouts.mainlayout')

@section('title') {{ __("lang.curricula") }} @endsection
@section('style')
@endsection

@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.subjects") }}
        @endslot
        @slot('item1')
            {{ __("lang.home") }}
        @endslot
        @slot('item2')
            {{ __("lang.subjects") }}
        @endslot
    @endcomponent


    @php
        $year = \App\Models\Year::with(['subjects' => function ($query) {
            $query->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value)
                  ->with(['curricula' => function ($query) {
                      $query->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value)
                        ->with(["courses" => function ($query) {
                            $query->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value);
                        }]);
                  }]);
        }])
        ->find(request('year_id'));
    @endphp


    <!-- Page Wrapper -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-sec">
                        <h2>{{ $year->yearTranslate->translates[app()->getLocale()] }}</h2>
                        <p>{{ __("lang.choose_your_curriculum") }}</p>
                    </div>

                    @if($year->subjects->count())
                        <!-- Category Tab -->
                        <div class="category-tab">
                            <ul class="nav nav-justified">
                                @foreach($year->subjects as $subject)
                                    <li class="nav-item">
                                        <a href="#subject_{{$subject->id}}" class="nav-link {{ $loop->first ? 'active' : '' }}" data-bs-toggle="tab">
                                            {{ $subject->subject->subjectTranslate->translates[app()->getLocale()] }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        <!-- /Category Tab -->

                        <!-- Category List -->
                        <div class="tab-content">

                            @foreach($year->subjects as $subject)

                                <div class="tab-pane fade show {{ $loop->first ? 'active' : '' }}" id="subject_{{$subject->id}}">
                                    <div class="row">
                                        @foreach($subject->curricula as $curriculum)
                                            <div class="col-lg-4 col-md-6">
                                                <div class="category-box">
                                                    <div class="category-title">
                                                        <div class="category-img">
                                                            <img src="{{ URL::asset('/build/img/category/category-01.jpg') }}"
                                                                 alt="">
                                                        </div>
                                                        <h5>{{ $curriculum->curriculumTranslate->translates[app()->getLocale()] }}</h5>
                                                    </div>
                                                    <div class="cat-count">
                                                        <span>{{ $curriculum->courses->count() }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /Category List -->

                    @else
                        <div class="error-box">
                            <div class="error-logo">
                                <a href="{{ url('index') }}">
                                    <img src="{{ URL::asset('/build/img/logo.svg') }}" class="img-fluid" alt="Logo">
                                </a>
                            </div>
                            <h4>WE ARE COMING SOON!!</h4>
                            <h6 class="font-weight-normal">Stay tuned for something amazing</h6>
                            <div class="countdown-container">
                                <div class="countdown-el days-c">
                                    <p class="big-text" id="days">0</p>
                                    <span>Days</span>
                                </div>
                                <div class="countdown-el hours-c">
                                    <p class="big-text" id="hours">0</p>
                                    <span>hrs</span>
                                </div>
                                <div class="countdown-el mins-c">
                                    <p class="big-text" id="mins">0</p>
                                    <span>mins</span>
                                </div>
                            </div>
                            <div class="error-box-img">
                                <img src="{{ URL::asset('/build/img/come-soon.png') }}" alt="" class="img-fluid">
                            </div>
                            <div class="come-soon-box">
                                <h5 class="h4 font-weight-normal">Subscribe to our mailing list to get latest updates</h5>
                                <div class="subscribe-soon">
                                    <form>
                                        <div class="input-group mb-3">
                                            <input type="text" class="form-control" placeholder="Email">
                                            <button class="btn btn-danger" type="button">Subscribe</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="social-icon-soon">
                                    <ul>
                                        <li><a href="javascript:;"><i class="fa-brands fa-facebook face-book"></i></a></li>
                                        <li><a href="javascript:;"><i class="fa-brands fa-twitter twit-ter"></i></a></li>
                                        <li><a href="javascript:;"><i class="fa-brands fa-instagram insta-gram"></i></a></li>
                                        <li><a href="javascript:;"><i class="fa-brands fa-linkedin linked-in"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection

