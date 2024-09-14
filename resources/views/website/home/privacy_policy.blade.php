@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.privacy_policy") }} @endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.privacy_policy") }}
        @endslot
        @slot('item1')
            {{ __("lang.home") }}
        @endslot
        @slot('item2')
            {{ __("lang.privacy_policy") }}
        @endslot
    @endcomponent
    @component('website_layouts.components.pagebanner')
        @slot('title')
            {{ __("lang.privacy_policy") }}
        @endslot
    @endcomponent

    @php $policies = \App\Models\PrivacyPolicy::where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)->get(); @endphp

        <!-- Help Details -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="terms-content">

                        @if(isset($policies) && $policies->count())
                            @foreach($policies as $policy)
                                <div class="terms-text">
                                    <h4>{{ $policy->headerTranslate->translates[app()->getLocale()] }}</h4>
                                    @php $explodes = explode("#", $policy->bodyTranslate->translates[app()->getLocale()]) @endphp
                                    @foreach($explodes as $explode)
                                        <p>{{ $explode }}</p>
                                    @endforeach
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- /Help Details -->
@endsection
