@extends('layouts.user.app')
@section('title_page')
@lang('site.portfolio')
@php
$page='portfolio';
@endphp
@endsection
@section('content')
<main class="bg-gray">
    <div class="dashboard-page py-5">
        <div class="container">
            <div class="row">
                @include('partials._profile_top_bar')
                <div class="col-lg-12 order-lg-3 order-md-3 order-2 mb-4">
                    <div class="table_style">
                        <div class="bg-white-shadow">
                            @include('partials._profile_bar')
                            <div class="p-2 bg-white-shadow">
                                <div class="row g-0 py-2 px-3 mb-3 row_header align-items-center">
                                    <div class="col-md-12 d-flex align-items-center px-3 justify-content-between">
                                        <strong class="me-auto">@lang('site.add')
                                            @lang('site.portfolio') </strong>
                                        <a href="{{ route('user.portfolio') }}" class="style-btn mt-0" type="button">
                                            <i class="fas fa fa-arrow-left"></i> @lang('site.back') </a>
                                    </div>
                                </div>
                                <!-- ##END Table Head -->
                                <div class="bg-white-shadow mb-3 p-3">
                                    <livewire:frontend.profile.portfolio />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection