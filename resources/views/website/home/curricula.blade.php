@extends('website_layouts.mainlayout')

@section('title') {{ __("lang.curricula") }} @endsection
@section('style')
    <style>
        .curriculum-types{
            background: #ffffff;
            box-shadow: 0px 0px 6px rgba(227, 227, 227, 0.85);
            border-radius: 0px 0px 10px 10px;
            padding: 20px;
            margin-bottom: 30px;
            display: -webkit-box;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -ms-flex-align: center;
            align-items: center;
            justify-content: space-between;
            -webkit-justify-content: space-between;
            -ms-flex-pack: space-between;
        }

        .edu-wrap {
            display: inline-block;
            word-wrap: break-word;
            max-width: 100%;
        }
    </style>
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
                                            <div class="col-lg-4 col-md-6 mb-3">
                                                <div class="category-box mb-0" style="border-bottom-left-radius: 0 !important;border-bottom-right-radius: 0 !important;">
                                                    <div class="category-title">
                                                        <h5><a href="{{ $curriculum->courses->count() ? route("student.courses", ["curriculum_id" => $curriculum->id]) : "#" }}">{{ $curriculum->curriculumTranslate->translates[app()->getLocale()] }}</a></h5>
                                                    </div>
                                                    <div class="cat-count">
                                                        <span>{{ $curriculum->courses->count() }}</span>
                                                    </div>
                                                </div>

                                                @if($curriculum->EduTermsEnums->count() || $curriculum->EduTypesEnums->count())
                                                    <div class="category-box p-3 curriculum-types">
                                                        <div class="row">
                                                            @if($curriculum->EduTermsEnums->count())
                                                                <div class="col-12">
                                                                    @foreach($curriculum->EduTermsEnums as $term)
                                                                        <small class="rounded rounded-2 text-center text-light p-2 mb-1 edu-wrap" style="background: #ff5364;">{{ $term->title() }}</small>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                            @if($curriculum->EduTypesEnums->count())
                                                                <div class="col-12">
                                                                    @foreach($curriculum->EduTypesEnums as $type)
                                                                        <small class="rounded rounded-2 text-center text-light p-2 mb-1 edu-wrap" style="background: #000000;">{{ $type->title() }}</small>
                                                                    @endforeach
                                                                </div>
                                                            @endif
                                                        </div>
                                                    </div>
                                                @endif
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <!-- /Category List -->

                    @else
                        @include("website_layouts.components.errors.coming_soon")
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- /Page Wrapper -->
@endsection

