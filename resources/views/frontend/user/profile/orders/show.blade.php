@extends('layouts.user.app')
@section('title_page')
    @lang('site.myOrders')
    @php
        $page = 'myOrders';
    @endphp
@endsection
@section('content')
    <main class="bg-gray">

        <div class="dashboard-page py-5">
            <div class="container">

                <div class="title_pages mb-4">
                    <strong class="h4 d-block"><i class="far fa-list-alt"></i> @lang('site.myOrders') </strong>
                </div>


                <section class="invoice ">
                    <!-- title row -->
                    <div class="row">
                        <div class="col-xs-12">
                            <h2 class="page-header">
                                <i class="fa fa-globe"></i> <b> @lang('site.order_number') </b>: {{ $order->id }}
                                <small class="pull-right"> @lang('site.created_at') : {{ $order->created_at }} </small>
                            </h2>
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- info row -->
                    <div class="row invoice-info">
                        <div class="col-sm-3 invoice-col">
                            <address>
                                <b> @lang('site.name') </b>: {{ $order->user->name }}
                                {{-- --}}

                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 invoice-col">
                            <address>
                                <b> @lang('site.total') </b>:  {{ $order->totalPrice }} EGP.
                                {{-- <b> @lang('site.payment_method') </b>: {{ $order->payment_method }} <br> --}}

                            </address>
                        </div>
                        <!-- /.col -->
                        <div class="col-sm-3 invoice-col">
                            <b> @lang('site.invoice_number') </b>: {{ $order->id }}  <br>
                            <b> @lang('site.shippedDate') </b>: {{ $order->shippedDate }} <br>
                            <b> @lang('site.haveSample') </b>: {{ $order->haveSample }} <br>
                            <b> @lang('site.notes') </b>: {{ $order->note }} <br>
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
                                            <th>@lang('site.orderTitle')</th>
                                            <th>@lang('site.finishesAndPaints')</th>
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
                                            <td>{{$order->id}}</td>
                                            <td>{{$order->orderTitle}}</td>
                                            <td>{{$order->finishesAndPaints}}</td>
                                            <td>{{$order->material}}</td>
                                            <td>
                                                <td><img src="{{ $order->image_path }}" style="width: 100px;" class="img-thumbnail"
                                                    alt="">
                                            </td>

                                            <td>{{$order->quantity}}</td>
                                            <td>{{$order->totalPrice}}</td>
                                            <td>{{ $order->status }} </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <strong>#@lang('site.material')</strong>
                                <table class="table table-striped">
                                    <thead>

                                        <tr>
                                            <th>#</th>
                                            <th>@lang('dash.products')</th>
                                        </tr>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->items as $key=>$item)

                                        <tr>
                                            <td>
                                                {{$key+1}}
                                            </td>
                                            <td>{{$item->productItem->title ??''}}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <strong>#@lang('site.documents')</strong>
                                <table class="table table-striped">
                                    <thead>

                                        <tr>
                                            <th>#</th>
                                            <th>@lang('site.documents')</th>
                                        </tr>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order->files as $key=>$item)

                                        <tr>
                                            <td>
                                                {{$key+1}}
                                            </td>
                                            <td><a href="{{$item->file_path}}" target="_blank">{{$item->file}}</a></td>
                                        </tr>
                                        @endforeach
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


            </div>
        </div>


    </main>
@endsection
