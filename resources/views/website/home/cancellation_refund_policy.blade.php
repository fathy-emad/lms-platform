@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.cancellation_refund_policy") }} @endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.cancellation_refund_policy") }}
        @endslot
        @slot('item1')
            {{ __("lang.home") }}
        @endslot
        @slot('item2')
            {{ __("lang.cancellation_refund_policy") }}
        @endslot
    @endcomponent
    @component('website_layouts.components.pagebanner')
        @slot('title')
            {{ __("lang.cancellation_refund_policy") }}
        @endslot
    @endcomponent

    @php $terms = \App\Models\CancellationRefundPolicy::where("ActiveEnum", \App\Enums\ActiveEnum::Active->value)->get(); @endphp

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
