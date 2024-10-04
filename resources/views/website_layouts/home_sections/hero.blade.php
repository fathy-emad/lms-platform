@php
    $stages = \App\Models\Stage::with(["stageTranslate"])
       ->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
       ->whereHas('years', function($query) {
           $query->where('ActiveEnum', \App\Enums\ActiveEnum::Active->value);
       })
       ->orderBy("priority")
       ->get();

    $years = \App\Models\Year::with(["yearTranslate", "curricula"])
       ->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
       ->orderBy("stage_id")
       ->orderBy("priority")
       ->get();
@endphp
<section class="home-slide d-flex align-items-center">
    <div class="container">
        <div class="row ">
            <div class="col-md-7">
                <div class="home-slide-face aos" data-aos="fade-up">
                    <div class="home-slide-text ">
                        <h5>{{ __("lang.hero_title_one") }}</h5>
                        <h1>{{ __("lang.hero_title_two") }}</h1>
                        <p>{{ __("lang.hero_title_three") }}</p>
                    </div>
                    <div class="banner-content">
                        <form class="form" action="course-list">
                            <div class="form-inner">
                                <div class="input-group row">
                                    <div class="col-sm-12 col-md-1">
                                        <i class="fa-solid fa-magnifying-glass search-icon mt-3"></i>
                                    </div>
                                    <div class="col-sm-12 col-md-5 text-center">
                                            <span class="drop-detail" style="width: 100%">
                                                <select class="form-select select" id="stages" onchange="selectYears()">
                                                   <option value="-1">-- {{ __("lang.select_stage") }} --</option>
                                                    @foreach($stages as $stage)
                                                        <option value="{{ $stage->id }}">{{ $stage->stageTranslate->translates[app()->getLocale()] }}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                    </div>
                                    <div class="col-sm-12 col-md-5">
                                            <span class="drop-detail" style="width: 100%">
                                                <select class="form-select select" id="years" onchange="onChangeYears(this)">
                                                    <option value="-1" data-stage="-1">-- {{ __("lang.select_category") }} --</option>
                                                    @foreach($years as $year)
                                                        <option value="{{ $year->id }}" data-stage="{{ $year->stage->id }}">{{ $year->yearTranslate->translates[app()->getLocale()] }}</option>
                                                    @endforeach
                                                </select>
                                            </span>
                                    </div>
                                    <div class="col-sm-12 col-md-1 text-center">
                                        <button class="btn btn-primary sub-btn" id="buttonSelectYear" type="button" onclick="getCurriculaOfYear()" disabled>
                                            <i @class(['fas', 'fa-arrow-right' => app()->getLocale() != 'ar', 'fa-arrow-left' => app()->getLocale() == 'ar'])></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="trust-user">
                        <p>{{ __("lang.hero_title_four", ["users" => 25000]) }} <br>{{ __("lang.hero_title_five") }}</p>
                        <div class="trust-rating d-flex align-items-center">
                            <div class="rate-head">
                                <h2><span>1000</span>+</h2>
                            </div>
                            <div class="rating d-flex align-items-center">
                                <h2 class="d-inline-block average-rating">4.4</h2>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                                <i class="fas fa-star filled"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 d-flex align-items-center">
                <div class="girl-slide-img aos" data-aos="fade-up">
                    <img src="{{ URL::asset('/build/img/object.png') }}" alt="Img">
                </div>
            </div>
        </div>
    </div>
</section>
