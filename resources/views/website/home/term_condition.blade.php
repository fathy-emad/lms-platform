@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.terms_condition") }} @endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.terms_condition") }}
        @endslot
        @slot('item1')
            {{ __("lang.home") }}
        @endslot
        @slot('item2')
            {{ __("lang.terms_condition") }}
        @endslot
    @endcomponent
    @component('website_layouts.components.pagebanner')
        @slot('title')
            {{ __("lang.terms_condition") }}
        @endslot
    @endcomponent

    @php $terms = \App\Models\TermsCondition::where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)->get(); @endphp

    <!-- Help Details -->
    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="terms-content">

                        @if(isset($terms) && $terms->count())
                            @foreach($terms as $term)
                                <div class="terms-text">
                                    <h4>{{ $term->headerTranslate->translates[app()->getLocale()] }}</h4>
                                    @php $explodes = explode("#", $term->bodyTranslate->translates[app()->getLocale()]) @endphp
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
