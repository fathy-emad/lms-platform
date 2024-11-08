@extends('website_layouts.mainlayout')
@section('title') {{ __("lang.invoices") }} @endsection
@section('content')
    @component('website_layouts.components.breadcrumb')
        @slot('title')
            {{ __("lang.invoices") }}
        @endslot
        @slot('item1')
            {{ __("lang.profile") }}
        @endslot
        @slot('item2')
            {{ __("lang.invoices") }}
        @endslot
    @endcomponent

    @php
        $student = auth("student")->user();
        $invoices = \App\Models\Invoice::with("payments.enrollment")->where("student_id", $student->id)->orderBy('created_at', 'desc')->paginate(6);
    @endphp

    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row">

                @component('website_layouts.components.sidebar')  @endcomponent

                <!-- Student Order History -->
                <div class="col-xl-9 col-lg-9">

                    <div class="settings-widget card-details">
                        <div class="settings-menu p-0">
                            <div class="profile-heading">
                                <h3>{{ __("lang.invoices") }}</h3>
                            </div>
                            <div class="checkout-form">
                                <div class="table-responsive custom-table">
                                    @if(session('message'))
                                        @dd("ddadada")
                                        <div class="alert alert-success">{{ session('message') }}</div>
                                    @endif
                                    <table class="table table-nowrap mb-0">
                                        <thead>
                                        <tr>
                                            <th></th>
                                            <th>{{ __("lang.invoice_id") }}</th>
                                            <th>{{ __("lang.total") }}</th>
                                            <th>{{ __("lang.count") }}</th>
                                            <th>{{ __("lang.courses") }}</th>
                                            <th>{{ __("lang.payment_method") }}</th>
                                            <th>{{ __("lang.date") }}</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @if($invoices->count())
                                            @foreach($invoices as $invoice)
                                                <tr>
                                                    <td>
                                                        <a href="#" class="action-icon"><i class="bx bxs-download"></i></a>
                                                    </td>
                                                    <td>#{{ $invoice->serial }}</td>
                                                    <td>{{ $invoice->totalCost }} LE</td>
                                                    <td>{{ $invoice->itemCount }}</td>
                                                    <td>
                                                        @foreach($invoice->payments as $payment)
                                                            <span class="title-course">
                                                                {{ $payment->enrollment->course->titleTranslate->translates[app()->getLocale()] }}
                                                                <small class="text-danger">({{ $payment->cost }} LE)</small>
                                                            </span>
                                                        @endforeach
                                                    </td>
                                                    <td>{{ $invoice->PaymentMethodEnum->title() }}</td>
                                                    <td>{{ $invoice->created_at }}</td>
                                                </tr>
                                            @endforeach

                                        @else
                                            <tr>
                                                <td rowspan="5">{{ __("lang.no_invoices") }}</td>
                                            </tr>
                                        @endif

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($invoices->count())
                        <div class="dash-pagination">
                            <div class="row align-items-center">
                                <div class="col-6">
                                    <p>Page {{$invoices->currentPage()}} of {{$invoices->lastPage()}}</p>
                                </div>
                                <div class="col-6">
                                    <ul class="pagination">
                                        @for($i = 1; $i <= ceil($invoices->total() / $invoices->perPage()); $i++)
                                            <li class="page-item first-page {{ $invoices->currentPage() == $i ? "active" : "" }}">
                                                <a class="page-link" href="{{ $invoices->path() . "?page=$i" }}">{{ $i }}</a>
                                            </li>
                                        @endfor
                                        @if($invoices->currentPage() < $invoices->lastPage())
                                            <li class="page-item next">
                                                <a class="page-link" href="{{ $invoices->path() . "?page=" . $invoices->currentPage() + 1 }}"><i class="bx bx-chevron-right"></i></a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- /Student Order History -->

            </div>
        </div>
    </div>
    <!-- /Page Content -->
@endsection
