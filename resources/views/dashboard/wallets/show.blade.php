@extends('layouts.dashboard.app')
<?php
$page = 'offers';
$title = trans('site.offers');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $title }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.offers.index') }}">{{ $title }}</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>
        @include('partials._errors')
        <!-- Main content -->
        <section class="invoice ">
            <!-- title row -->
            <div class="row">
                <div class="col-xs-12">
                    <h2 class="page-header">
                        <i class="fa fa-globe"></i> <b>orderID</b>:{{ userTagID() . $offer->order->id }}


                        <small class="pull-right"> @lang('site.created_at') : {{ $offer->created_at }} </small>
                    </h2>
                </div>
                <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
                <div class="col-sm-3 invoice-col">
                    <address>
                        <b>@lang('site.name')</b>:{{ $offer->user->name }} <br>
                        <b>@lang('site.email') </b>:{{ $offer->user->email }} <br>



                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">
                    <address>

                        <b> @lang('site.dateFrom') </b>: {{ $offer->dateFrom }}
                        <b> @lang('site.dateTo') </b>: {{ $offer->dateTo }} <br>
                        <b> @lang('site.priceUnit') </b>: {{ $offer->priceUnit }} EGP <br>
                        <b> @lang('site.priceDeposit') </b>: {{ $offer->priceDeposit }} EGP <br>
                        <b> @lang('site.priceTotal') </b>: {{ $offer->priceTotal }} EGP<br>

                        <b> @lang('site.priceSample') </b>: {{ $offer->priceSample }} EGP<br>
                        <b> @lang('site.provideSample') </b>: {{ $offer->provideSample }} <br>

                        <b> @lang('site.manufacturingMethod') </b>: {{ $offer->manufacturingMethod }} <br>
                        <b> @lang('site.madeSameSample') </b>: {{ $offer->madeSameSample }} <br>
                        <b> @lang('site.notes') </b>: {{ $offer->notes }} <br>
                        <b> @lang('site.adminNotes') </b>: {{ $offer->adminNotes }} <br>
                        <b> @lang('site.status') </b>:    {!! lbl_status($offer->status) !!} <br>


                        <img src="{{ $offer->file_path}}" alt="" srcset=""> <br>
                        {{-- <b> @lang('site.file') </b>: {{ $offer->file2 }} <br>
                        <b> @lang('site.file') </b>: {{ $offer->file3 }} <br> --}}


                    </address>
                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col">


                </div>
                <!-- /.col -->
                <div class="col-sm-3 invoice-col" style="background-color: #3c8dbc">
                    <img src="{{ $setting->image_logo }}" class="" width="" height="80" alt="">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- Table row -->

            <!-- /.row -->
            <div class="row">
                <!-- accepted payments column -->
                <div class="col-xs-6">
                </div>
                <!-- /.col -->
                <div class="col-xs-6">
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
            <!-- this row will not appear when printing -->
            <div class="row no-print">
                <div class="col-xs-12">
                    <button onclick="window.print();" class="btn btn-primary"><i
                            class="fa fa-print"></i>@lang('site.print')</button>
                </div>
            </div>
        </section>

        <!-- /.content -->
    </div><!-- end of content wrapper -->
@endsection
