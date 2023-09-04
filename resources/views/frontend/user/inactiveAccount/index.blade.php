@extends('layouts.app')
@section('title_page')
Activate your account
@php
$page='Activate your account';
@endphp
@endsection

@section('content')
<main class="bg-gray">
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-page bg-white-shadow py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.home') </a></li>
                    <li class="breadcrumb-item active" aria-current="page"> Activate your account</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- //END => Breadcrumb -->


    <div class="alert alert-danger text-center">

        Activate your account
    </div>
</main>


@endsection