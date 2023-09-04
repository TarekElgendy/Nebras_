@extends('layouts.dashboard.app')
<?php
$page = 'timeLines';
$title = trans('dash.timeLines');
// to hide any section please type -> close
$timeLine_search = '';
$timeLine_add = '';
$timeLine_edit = ' ';
$timeLine_delete = 'close';
?>
@section('title_page')
{{ $title }}
@endsection
@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>@lang('dash.timeLines')</h1>
        <ol class="breadcrumb">
            <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.dashboard')</a>
            </li>
            <li class="active">@lang('dash.timeLines')</li>
        </ol>
    </section>
    <section class="content">
        <div class="box box-primary">
            <div class="box-header with-btimeLine">
                <h3 class="box-title" style="margin-bottom: 15px">@lang('dash.timeLines')
                    <small>
                        @lang('site.total_search')
                        ( {{ count($timeLines) }} )
                    </small>
                </h3>
                <form action="{{ route('dashboard.timeLines.index') }}" method="get">
                    <div class="row">
                        <div class="{{ $timeLine_search == 'close' ? 'hidden' : '' }}">
                            <div class="col-md-4">
                                <input type="text" name="search" class="form-control" placeholder="@lang('site.search')"
                                    value="{{ request()->search }}">
                            </div>

                            <div class="col-md-4">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-search"></i>
                                    @lang('site.search')</button>
                            </div>
                        </div>
                        <div class="col-md-4 {{ $timeLine_add == 'close' ? 'hidden' : '' }}">
                            @if (auth()->user()->hasPermission('timeLines-create'))
                            <a href="{{ route('dashboard.timeLines.create') }}" class="btn btn-primary"><i
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
                @if ($timeLines->count() > 0)
                <table class="table table-hover" id="data_table">
                    <thead>
                        <tr>
                            <th>#</th>

                            <th>@lang('site.orders')</th>

                            <th>@lang('site.title')</th>
                             <th>@lang('site.status')</th>
                             <th>@lang('site.created_at')</th>
                            <th>@lang('site.action')</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($timeLines as $index => $timeLine)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>
                                <a href="{{route('dashboard.orders.show',[$timeLine->order_id])}}">{{userTagID().$timeLine->order_id}} </a>
                            </td>
                            <td>
                                {{$timeLine->title}}
                            </td>
                            <td>
                                @lang('site.'.$timeLine->status)
                            </td>
                            <td>
                                {{$timeLine->created_at}}
                            </td>
                            <td>
                                @if (auth()->user()->hasPermission('timeLines-read'))
                                <a href="{{ route('dashboard.timeLines.show', $timeLine->id) }}"
                                    class="btn btn-success btn-sm"><i
                                        class="fa fa-eye"></i> @lang('site.read')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif
                                @if (auth()->user()->hasPermission('timeLines-update'))
                                <a href="{{ route('dashboard.timeLines.edit', $timeLine->id) }}"
                                    class="btn btn-info btn-sm {{ $timeLine_edit == 'close' ? 'hidden' : '' }}"><i
                                        class="fa fa-edit"></i> @lang('site.edit')</a>
                                @else
                                <a href="#" class="btn btn-info btn-sm disabled"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</a>
                                @endif

                                @if (auth()->user()->hasPermission('timeLines-delete'))
                                <form action="{{ route('dashboard.timeLines.destroy', $timeLine->id) }}" method="post"
                                    style="display: inline-block">
                                    {{ csrf_field() }}
                                    {{ method_field('delete') }}
                                    <button type="submit"
                                        class="btn btn-danger delete btn-sm {{ $timeLine_delete == 'close' ? 'hidden' : '' }}"><i
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
