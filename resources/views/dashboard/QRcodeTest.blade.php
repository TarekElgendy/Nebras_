@extends('layouts.dashboard.app')
<?php
$page = 'dashboard';
$title = trans('site.dashboard');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">

        <section class="content-header">

            <h1>@lang('site.dashboard')</h1>

            <ol class="breadcrumb">
                <li class="active"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</li>
            </ol>
        </section>

        <section class="content">

            Hello Dear {{ auth()->user()->name }}
            <br>
            check : https://www.simplesoftware.io/#/docs/simple-qrcode

            {!! QrCode::size(300)->style('dot')->email('tarek122gamal@gmail.com') !!}
            {!! QrCode::size(300)->style('dot')->email('tarek122gamal@gmail.com') !!}
            <br>
            {!! QrCode::size(300)->phoneNumber('01142117402') !!}
            <br>

            {!! QrCode::size(300)->backgroundColor(255, 90, 0)->generate('http://innovzone.com') !!}

        </section><!-- end of content -->

    </div><!-- end of content wrapper -->
@endsection
