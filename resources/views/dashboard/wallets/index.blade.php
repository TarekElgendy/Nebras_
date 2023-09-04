@extends('layouts.dashboard.app')
<?php
$page = 'wallets';
$title = trans('dash.wallets');
// to hide any section please type -> close
$wallet_search = '';
$wallet_add = '';
$wallet_edit = 'close';
$wallet_show = 'close';
$wallet_delete = 'close';
?>
@section('title_page')
{{ $title }}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dash.wallets')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('dash.wallets')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-bwallet">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.wallets')
                    <small>
                        @lang('site.total_search')
                        ( {{ count($wallets) }} )
                    </small>
                </h3>
                <form action="{{ route('dashboard.wallets.index') }}" method="get">
                    <div class="row">
                        <div class="{{ $wallet_search == 'close' ? 'hidden' : '' }}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>
                        </div>
                        <div class="col-md-4 {{ $wallet_add == 'close' ? 'hidden' : '' }}">
                            @if (auth()->user()->hasPermission('wallets-create'))
                            <a href="{{ route('dashboard.wallets.create') }}" class="btn btn-primary"><i
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
                @if ($wallets->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>Order ID</th>
                            <th>@lang('site.clients')</th>

                            <th>@lang('site.status')</th>
                            <th>@lang('site.created_at')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($wallets as $index => $wallet)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>
                                <a href="{{route('dashboard.users.index',['id'=>$wallet->user_id])}}"> {{ $wallet->user->name }}</a>
                            </td>
                            <td>
                                الرصيد الكلي
                                {{$wallet->balance}}
                           ’<br>
                                الرصيد المعلق
                                {{$wallet->balance_pinnding}}
                            </td>

                            <td>
                                {!! lbl_status($wallet->status) !!}
                            </td>
                            <td>
                                {{$wallet->created_at}}
                                <br>
                                {{$wallet->updated_at}}
                            </td>
                            <td>
                                @if (auth()->user()->hasPermission('wallets-read'))
                                <a href="{{ route('dashboard.wallets.show', $wallet->id) }}"
                                    class="btn btn-success btn-sm {{ $wallet_show == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-eye"></i> @lang('site.read')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('wallets-update'))
                                <a href="{{ route('dashboard.wallets.edit', $wallet->id) }}"
                                    class="btn btn-info btn-sm {{ $wallet_edit == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif

                                @if (auth()->user()->hasPermission('wallets-delete'))
                                <form action="{{ route('dashboard.wallets.destroy', $wallet->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit"
                                        class="btn btn-danger delete btn-sm {{ $wallet_delete == 'close' ? 'hidden' : '' }}"><i
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
