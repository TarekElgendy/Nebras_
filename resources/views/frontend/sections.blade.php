@extends('layouts.app')
@section('title_page')
@lang('site.services')
@php
$page='services';
@endphp
@endsection
@section('des_seo')

@endsection
@section('key_seo')

@endsection
@section('content')
<main class="bg-gray">
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-page bg-white-shadow mb-0 py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.home') </a></li>
                    <li class="breadcrumb-item active" aria-current="page"> @lang('site.services')</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- //END => Breadcrumb -->

    <div class="page-howworks py-5">
        <div class="container">
            @foreach ($sections as $item)


            <div class="row mb-5 gx-lg-3 gx-md-3 gx-0">
                <div class="col-lg-4 col-md-4 col-12 order-lg-1 order-md-1 order-1 mb-lg-0 mb-md-0 mb-3">
                    <div class="img_how">
                        <img src="{{$item->image_path  }}" class="img-fluid rounded-3" alt="{{$item->title  }}">
                    </div>
                </div>
                <div class="col-lg-8 col-md-8 col-12 order-lg-2 order-md-2 order-2 p-3 bg-white-shadow rounded-3">
                    <div class="section-title mb-3">
                        <strong class="h4 fw-bold"> {{$item->title }} </strong>
                        <div class="bar-main">
                            <div class="bar bar-big m-0"></div>
                        </div>
                    </div>
                    <p class="m-0">
                        {!! $item->description !!}
                    </p>
                    <a href="{{ route('categories',['id'=>$item->id,'slug'=>make_slug($item->title)]) }}"
                        class="style-btn px-4 py-2"> اقرأ المزيد </a>
                </div>
            </div>
            @endforeach



        </div>
    </div>


</main>



@endsection
