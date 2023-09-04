@extends('layouts.dashboard.app')
<?php
$page="offers";
$title=trans('site.offers');
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
            <li><a href="{{ route('dashboard.offers.index') }}">{{$title}}</a></li>
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
                    <i class="fa fa-globe"></i> <b> @lang('site.offer_number') </b>: {{ $offer->id }}
                    <small class="pull-right"> @lang('site.created_at') : {{ $offer->created_at }} </small>
                </h2>
            </div>
            <!-- /.col -->
        </div>
        <!-- info row -->
        <div class="row invoice-info">
            <div class="col-sm-3 invoice-col">
                <address>
                    <b> @lang('site.name') </b>: {{ $offer->user->name }}
                    {{-- --}}

                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
                <address>
                    <b> @lang('site.total') </b>:  {{ $offer->totalPrice }} EGP.
                    {{-- <b> @lang('site.payment_method') </b>: {{ $offer->payment_method }} <br> --}}

                </address>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
                <b> @lang('site.invoice_number') </b>: {{ $offer->id }}  <br>
                <b> @lang('site.shippedDate') </b>: {{ $offer->shippedDate }} <br>
                <b> @lang('site.haveSample') </b>: {{ $offer->haveSample }} <br>
                <b> @lang('site.notes') </b>: {{ $offer->note }} <br>
            </div>
            <!-- /.col -->
            <div class="col-sm-3 invoice-col">
                <img src="{{$setting->image_logo}}" class="" width="80" height="80" alt="">
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        <!-- Table row -->
        <div class="row  ">
            <div class="box box-primary">
                <div class="col-xs-12 table-responsive">
                    <strong>#@lang('site.info')</strong>
                    <table class="table table-striped">
                        <thead>
                            <tr>


                                <th>@lang('site.invoice_number')</th>
                                <th>@lang('site.offerTitle')</th>
                                <th>@lang('site.material')</th>
                                <th>@lang('site.image')</th>
                                <th>@lang('site.quantity')</th>
                                <th>@lang('site.total')</th>
                                <th>@lang('site.status')</th>

                            </tr>
                        </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{$offer->id}}</td>
                                <td>{{$offer->offerTitle}}</td>
                                <td>{{$offer->material}}</td>
                                <td>
                                    <td><img src="{{ $offer->image_path }}" style="width: 100px;" class="img-thumbnail"
                                        alt="">
                                </td>

                                <td>{{$offer->quantity}}</td>
                                <td>{{$offer->totalPrice}}</td>
                                <td>{{ $offer->status }} </td>
                            </tr>
                        </tbody>
                    </table>



                </div>
            </div>
            <!-- /.col -->
        </div>
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
    <section class="content">
        <div class="box box-default no-print">
            <div class="box-header with-boffer">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div>
            <div class="box-body">
                @include('partials._errors')
                <form action="{{ route('dashboard.offers.update', $offer->id) }}" method="POST"
                    enctype="multipart/form-data">
                    {{ csrf_field() }}
                              {{ method_field('put') }}
                    <div class="col-md-12">

                        <div class=" form-group ">
                            <label>@lang('site.status') </label>
                            <select class="form-control" name="status" id="">
                                <option value="">@lang('site.status')</option>
                                @foreach (offerStatus() as $item)
                                <option value="{{$item}}" {{$offer->status==$item?'selected':''}}>@lang('site.'.$item)</option>

                                @endforeach
                                </select>
                                <label style="color: red"> *
                                     </label>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary"><i class="fa fa-edit"></i>
                                @lang('site.edit')</button>
                        </div>
                    </div>
                </form>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </section>
    <!-- /.content -->
</div><!-- end of content wrapper -->
@endsection
