@extends('layouts.dashboard.app')
<?php
$page = 'orders';
$title = trans('dash.orders');
// to hide any section please type -> close
$order_search = '';
$order_add = 'close';
$order_edit = ' ';
$order_delete = 'close';
?>
@section('title_page')
{{ $title }}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dash.orders')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('dash.orders')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.orders')
                    <small>
                        @lang('site.total_search')
                        ( {{ count($orders) }} )
                    </small>
                </h3>
                <form action="{{ route('dashboard.orders.index') }}" method="get">
                    <div class="row">
                        <div class="{{ $order_search == 'close' ? 'hidden' : '' }}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>
                        </div>
                        <div class="col-md-4 {{ $order_add == 'close' ? 'hidden' : '' }}">
                            @if (auth()->user()->hasPermission('orders-create'))
                            <a href="{{ route('dashboard.orders.create') }}" class="btn btn-primary"><i
                                    class="fa fa-plus"></i> @lang('site.add')</a>
                            @else
                            <a href="#" class="btn btn-primary disabled"><i class="fa fa-plus"></i>
                                @lang('site.add')</a>
                            @endif
                        </div>
                    </div>
                </form><!-- end of form -->
            </div><!-- end of box header -->
            <div class="box-body">
                @if ($orders->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>@lang('site.clients')</th>

                            <th>@lang('site.orderTitle')</th>
                             <th>@lang('site.status')</th>
                             <th>@lang('site.timeLines')</th>
                             <th>@lang('site.created_at')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{route('dashboard.users.index',['id'=>$order->user->id])}}"> {{ $order->user->name }}</a>
                            </td>
                            <td>
                                {{$order->orderTitle}}
                            </td>
                            <td>
                                @lang('site.'.$order->status)
                            </td>
                            <td>
                                @if (auth()->user()->hasPermission('timeLines-read'))
                                <a href="{{ route('dashboard.timeLines.index', ['order_id'=>$order->id]) }}"
                                    class="btn btn-danger btn-sm"> {{count($order->timeLines)}}</a>
                                @endif
                            </td>
                            <td>

                                {{$order->created_at}}
                            </td>

                            <td>
                                @if (auth()->user()->hasPermission('orders-read'))
                                <a href="{{ route('dashboard.orders.show', $order->id) }}"
                                    class="btn btn-success btn-sm"><i
                                        class="fa fa-eye"></i> @lang('site.read')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('orders-update'))
                                <a href="{{ route('dashboard.orders.edit', $order->id) }}"
                                    class="btn btn-info btn-sm {{ $order_edit == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif

                                @if (auth()->user()->hasPermission('orders-delete'))
                                <form action="{{ route('dashboard.orders.destroy', $order->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit"
                                        class="btn btn-danger delete btn-sm {{ $order_delete == 'close' ? 'hidden' : '' }}"><i
                                            class="fa fa-trash"></i> @lang('site.delete')</button>
                                </form><!-- end of form -->
                                @else
                                <button class="btn btn-danger btn-sm disabled"><i class="fa fa-trash"></i>
                                    @lang('site.delete')</button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table><!-- end of table -->
                @else
                <label for="" class="alert alert-danger col-xs-12 text-center">@lang('site.no_data_found')</label>
                @endif
            </div><!-- end of box body -->
        </div><!-- end of box -->
    </section><!-- end of content -->
</div><!-- end of content wrapper -->
@endsection
