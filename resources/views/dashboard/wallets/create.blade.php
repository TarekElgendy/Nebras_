@extends('layouts.dashboard.app')
<?php
$page = 'wallets';
$title = trans('dash.wallets');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>@lang('dash.wallets')</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('dash.dashboard')</a>
                </li>
                <li><a href="{{ route('dashboard.wallets.index') }}"> @lang('dash.wallets')</a></li>
                <li class="active">@lang('dash.add')</li>
            </ol>
        </section>
        <section class="content">
            <div class="">
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{ route('dashboard.wallets.store') }}" method="post" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('post') }}
                        <div class="col-md-4">
                            <!-- /one -->
                            <div class="box box-primary ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>SITE</strong> INFO</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">

                                        <div class="form-group">
                                            <label>@lang('dash.users') </label>
                                            <select name="user_id" required="required" class="form-control">
                                                <option value="">@lang('dash.select') @lang('dash.users')</option>
                                                @foreach ($users as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name . ' /'.$item->email }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>@lang('dash.balance')</label>
                                            <input type="number" required="required" name="balance" class="form-control"
                                                value="{{ old('balance') }}">
                                        </div>


                                    </div>
                                </div>
                            </div>
                        </div>{{-- end col md  --}}


                        <div class="col-md-12">

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-plus"></i>
                                    @lang('dash.add')</button>
                            </div>
                        </div>
                    </form><!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->
@endsection
