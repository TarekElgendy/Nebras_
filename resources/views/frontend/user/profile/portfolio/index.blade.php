@extends('layouts.user.app')
@section('title_page')
@lang('site.portfolio')
@php
$page = 'portfolio';
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
                                <!-- ##END Table Head -->
                                <div class="bg-white-shadow mb-3 p-3">
                                    <div class="tab-pane " id="works" role="tabpanel" aria-labelledby="disabled-tab"
                                        tabindex="0">
                                        <div class="table_style">
                                            <!-- Table Head -->
                                            <div class="row g-0 row_header align-items-center">
                                                <div
                                                    class="col-md-12 d-flex align-items-center px-3 justify-content-between">
                                                    <strong class="me-auto">{{ userTagID() }}-{{ auth()->user()->id }}
                                                    </strong>
                                                    <a href="{{ route('user.portfolio.create') }}"
                                                        class="style-btn mt-2 mb-2 ">
                                                        <i class="fas fa-plus"></i> @lang('site.add') </a>
                                                </div>
                                            </div>
                                            <!-- ##END Table Head -->
                                            <div class="row py-4 px-3 g-4">
                                                @foreach ($portfolios as $item)
                                                <div class="col-md-4">
                                                    <div class="item-work bg-white-shadow rounded-3">
                                                        <a href="{{ route('user.portfolio.delete', $item->id) }}"
                                                            type="button" class="edit-btn style-btn" aria-label="edit">
                                                            <i class=" fa fa-fw fa-trash"></i>
                                                            @lang('site.delete')
                                                        </a>
                                                        <div class="img_work">
                                                            <img src="{{ $item->image_path }}" class="img-fluid"
                                                                alt="work">
                                                            <a href="{{ $item->image_path }}" class="zoom-link"
                                                                data-fancybox="gallery" aria-label="zoom">
                                                                <i class="fas fa-search"></i>
                                                            </a>
                                                        </div>
                                                        <a href="" class="link"> {{ $item->title }} </a>
                                                    </div>
                                                </div>
                                                @endforeach

                                            </div>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection