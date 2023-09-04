@extends('layouts.app')
@section('title_page')
@lang('site.contact')
@php
$page='contact';
@endphp
@endsection
@section('content')

<main class="bg-gray">
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-page bg-white-shadow mb-0 py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.home') </a></li>
                    <li class="breadcrumb-item active" aria-current="page"> @lang('site.contact')</li>
                </ol>
            </nav>
        </div>
    </div>
    <!-- //END => Breadcrumb -->

    <div class="maps">
        {!! $setting->map !!}
    </div>

    <div class="contact-page container py-4">
        <div class="bg-white-shadow p-lg-5 p-md-5 p-2 rounded-3 w-75 m-auto">

            <div class="row">
                <div class="col-md-5 info-contact mb-4">
                    <strong class="h4 mb-5 d-block"> @lang('site.Get In Touch') </strong>
                    <ul>
                        <li> <i class="fas fa-map-marker-alt me-2"></i> <strong> @lang('site.address') :</strong>
                            {{ $setting->address }}
                        <li> <a href="mailto:{{ $setting->email }}"><i class="far fa-envelope me-2"></i> {{
                                $setting->email }}
                            </a> </li>
                        <li> <a href="tel:{{ $setting->num1 }}"><i class="fas fa-phone-volume me-2"></i>
                                <bdi>{{ $setting->num1 }}</bdi> </a>
                        </li>
                    </ul>
                    <div class="social-icons mt-4">
                        <a href="{{ $setting->facebook}}" aria-label="facebook"> <i class="fab fa-lg fa-facebook-f"></i>
                        </a>
                        <a href="{{ $setting->twitter}}" aria-label="twitter"> <i class="fab fa-lg fa-twitter"></i> </a>
                        <a href="{{ $setting->instagram}}" aria-label="instagram"> <i
                                class="fab fa-lg fa-instagram"></i> </a>
                        <a href="{{ $setting->youtube}}" aria-label="youtube"> <i class="fab fa-lg fa-youtube"></i> </a>

                    </div>
                </div>
                <div class="col-md-7">
                    <livewire:frontend.contact />

                </div>
            </div>

        </div>
    </div>

</main>



@endsection