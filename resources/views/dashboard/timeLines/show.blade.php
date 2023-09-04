@extends('layouts.dashboard.app')
<?php
$page="timeLines";
$title=trans('site.timeLines');
?>
@section('title_page')
{{$title}}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>{{$title}}</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li><a href="{{ route('dashboard.timeLines.index') }}">{{$title}}</a></li>
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
                 {{userTagID().$timeLine->order_id}}
                <b> / </b>  {{ $timeLine->page->title }}
                    <small class="pull-right"> @lang('site.created_at') : {{ $timeLine->created_at }} </small>
                 </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">

            <!-- /.col -->
            <div class="col-sm-12 invoice-col">
                <address>
                    <b> @lang('site.title') </b>:  {{ $timeLine->title }} <br>
                    <b> @lang('site.description') </b>:  {!!$timeLine->description !!} <br>

                </address>
            </div>

        </div>
        <!-- /.row -->
        <!-- Table row -->


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
