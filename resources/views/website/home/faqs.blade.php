@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.faqs") }} @endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.faqs") }}
        @endslot
        @slot('item1')
            {{ __("lang.home") }}
        @endslot
        @slot('item2')
            {{ __("lang.faqs") }}
        @endslot
    @endcomponent
    @component('website_layouts.components.pagebanner')
        @slot('title')
            {{ __("lang.faqs") }}
        @endslot
        @slot('li1')
             {{ __("lang.faqs_title") }}
        @endslot
    @endcomponent

    @php $faqs = \App\Models\FAQ::where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)->get(); @endphp


    @if(isset($faqs) && $faqs->count())
        <!-- Help Details -->
        <div class="help-sec">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="help-title">
                            <h1>{{ __("lang.faqs_header") }}</h1>
                            <p>{{ __("lang.faqs_description") }}</p>
                        </div>
                    </div>
                </div>

                <div class="row">

                    @foreach($faqs as $faq)
                        <div class="col-lg-6">
                            <!-- Faq -->
                            <div class="faq-card">
                                <h6 class="faq-title">
                                    <a class="collapsed" data-bs-toggle="collapse" href="#faq-{{$faq->id}}" aria-expanded="false">{{ $faq->questionTranslate->translates[app()->getLocale()] }}</a>
                                </h6>
                                <div id="faq-{{$faq->id}}" class="collapse">
                                    <div class="faq-detail">
                                        @php $explodes = explode("#", $faq->answerTranslate->translates[app()->getLocale()]) @endphp
                                        @foreach($explodes as $explode)
                                            <p>{{ $explode }}</p>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- /Faq -->

                        </div>
                    @endforeach
                </div>
            </div>
        </div>
        <!-- /Help Details -->
    @endif


    <!-- Help Details -->
    <div class="support-sec">

        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="help-title sup-title">
                        <h1>{{ __("lang.contactus_header") }}</h1>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="support-card">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>{{ __("lang.contactus") }}</h3>
                                <p>{{ __("lang.contactus_description") }}</p>
                                <a href="javascript:;" class="btn btn-contact">{{ __("lang.contactus") }}</a>
                            </div>
                            <div class="col-md-4">
                                <div class="support-img">
                                    <img src="{{ URL::asset('/build/img/service-01.png') }}" class="img-fluid"
                                         alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="support-card">
                        <div class="row">
                            <div class="col-md-8">
                                <h3>{{ __("lang.support") }}</h3>
                                <p>{{ __("lang.support_description") }}</p>
                                <a href="javascript:;" class="btn btn-ticket">{{ __("lang.support") }}</a>
                            </div>
                            <div class="col-md-4">
                                <div class="support-img">
                                    <img src="{{ URL::asset('/build/img/service-02.png') }}" class="img-fluid"
                                         alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- /Help Details -->
@endsection
