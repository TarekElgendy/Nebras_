@extends('layouts.dashboard.app')
<?php
$page = 'offers';
$title = trans('dash.offers');
// to hide any section please type -> close
$offer_search = '';
$offer_add = 'close';
$offer_edit = ' ';
$offer_delete = 'close';
?>
@section('title_page')
{{ $title }}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dash.offers')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('dash.offers')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-boffer">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.offers')
                    <small>
                        @lang('site.total_search')
                        ( {{ count($offers) }} )
                    </small>
                </h3>
                <form action="{{ route('dashboard.offers.index') }}" method="get">
                    <div class="row">
                        <div class="{{ $offer_search == 'close' ? 'hidden' : '' }}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>
                        </div>
                        <div class="col-md-4 {{ $offer_add == 'close' ? 'hidden' : '' }}">
                            @if (auth()->user()->hasPermission('offers-create'))
                            <a href="{{ route('dashboard.offers.create') }}" class="btn btn-primary"><i
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
                @if ($offers->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Order ID</th>
                            <th>@lang('site.clients')</th>

                            <th>@lang('site.status')</th>
                            <th>@lang('site.customerApproval')</th>
                            <th>@lang('site.created_at')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($offers as $index => $offer)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{ route('dashboard.orders.show', $offer->order->id) }}">{{ userTagID().$offer->order->id }} </a>
                            </td>
                            <td>
                                <a href="{{route('dashboard.users.index',['id'=>$offer->user->id])}}"> {{ $offer->user->name }}</a>
                            </td>

                            <td>
                                {!! lbl_status($offer->status) !!}
                            </td>
                            <td>
                                {!! lbl_status($offer->customerApproval) !!}
                            </td>
                            <td>
                                {{$offer->created_at}}
                            </td>
                            <td>
                                @if (auth()->user()->hasPermission('offers-read'))
                                <a href="{{ route('dashboard.offers.show', $offer->id) }}"
                                    class="btn btn-success btn-sm"><i
                                        class="fa fa-eye"></i> @lang('site.read')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('offers-update'))
                                <a href="{{ route('dashboard.offers.edit', $offer->id) }}"
                                    class="btn btn-info btn-sm {{ $offer_edit == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif

                                @if (auth()->user()->hasPermission('offers-delete'))
                                <form action="{{ route('dashboard.offers.destroy', $offer->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit"
                                        class="btn btn-danger delete btn-sm {{ $offer_delete == 'close' ? 'hidden' : '' }}"><i
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
