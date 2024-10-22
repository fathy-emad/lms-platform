@php
    $years = \App\Models\Year::with(["yearTranslate", "curricula"])
       ->where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)
       ->orderBy("stage_id")
       ->orderBy("priority")
       ->get();
@endphp
<section class="section how-it-works">
    <div class="container">
        <div class="section-header aos" data-aos="fade-up">
            <div class="section-sub-head">
                <span>{{ __("lang.all_years") }}</span>
                <h2>{{ __("lang.top_years") }}</h2>
            </div>
        </div>
        <div class="section-text aos" data-aos="fade-up">
            <p>
                {{ __("lang.all_years_description") }}
            </p>
        </div>
        <div class="owl-carousel mentoring-course owl-theme aos" data-aos="fade-up">
            @foreach($years as $year)
                <div class="feature-box text-center ">
                    <div class="feature-bg">
                        <div class="feature-header">
                            <div class="feature-icon">
                                <a href="{{ route("student.curricula", ["year_id" => $year->id]) }}">
                                    <img src="{{ URL::asset(isset($year->image["file"]) ? 'uploads/' . $year->image["file"] : '/build/img/categories-icon.png') }}" alt="Img">
                                </a>
                            </div>
                            <div class="feature-cont">
                                <div class="feature-text">
                                    <a href="{{ route("student.curricula", ["year_id" => $year->id]) }}">
                                        {{ $year->yearTranslate->translates[app()->getLocale()] }}
                                    </a>
                                </div>
                            </div>
                        </div>
                        <p>{{ array_sum(array_column($year->curricula->loadCount("courses")->toArray(), "courses_count")) }} {{ __("lang.courses") }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
