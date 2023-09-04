@extends('layouts.app')
@section('title_page')
@lang('site.tickets')
@php
$profile_bar='tickets';
@endphp
@endsection
@section('content')
<!-- START => Breadcrumb -->
<div class="head-pages">
    <div class="breadcrumb-bg"></div>
    <div class="container-fluid">
        <div class="breadcrumb-title">
            <strong>@lang('site.We keep pace with development to create an easier life')</strong>
        </div>
        <div class="breadcrumb-pages">
            <ul class="d-flex align-items-center">
                <li><a href="{{route('home')}}">@lang('site.home')</a></li>
                <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
                <li><a href="{{route('customer.profile.index')}}">@lang('site.profile')</a></li>
                <li class="mx-2"> <i class="fa fa-chevron-right fa-sm"></i> </li>
                <li><a href="">@lang('site.Technical Support')</a></li>
            </ul>
        </div>
    </div>
</div>
<!-- //END => Breadcrumb -->
<!-- START => Profile Page -->
<section class="page-profile py-5">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-3">
                @include('partials._profile_bar')
            </div>
            <div class="col-md-9">
                <div class="profile-content">
                    <div class="title-profile px-2">
                        <strong class="h5 d-block">@lang('site.Technical Support')</strong>

                    </div>
                    <div class="box-bg box-chating">
                        <div class="items-chats px-2">



                              <div class="d-flex   ">
                            @lang('site.section') &nbsp; : {{ __('site.'.$ticket->section )}} &nbsp; &nbsp; &nbsp; -
                            @lang('site.type') &nbsp; : {{ __('site.'.$ticket->type) }} &nbsp; &nbsp; &nbsp; -
                            @lang('site.status') &nbsp; : {{ __('site.'.$ticket->status) }} &nbsp; &nbsp; &nbsp;
                            @lang('site.created_at') &nbsp; :{{$ticket->created_at}}  &nbsp; &nbsp; &nbsp;
                            </div>

                               <div
                                class="d-flex  {{$ticket->reply !=null?'justify-content-start':'justify-content-end'}} ">
                                <div class="item-chat   {{$ticket->reply !=null?'send':'replay'}} ">
                                    <strong
                                        class="name-user">{{$ticket->reply !=null? 'Tech Team' :auth()->user()->full_name}}</strong>
                                    <p>{{$ticket->reply}} {{$ticket->message}} </p>
                                    <span>{{$ticket->created_at}}</span>
                                </div>
                            </div>



                            @foreach ($tickets_details as $item)
                             <div
                                class="d-flex  {{$item->admin_id !=null?'justify-content-start':'justify-content-end'}} ">
                                <div class="item-chat   {{$item->admin_id !=null?'send':'replay'}} ">
                                    <strong
                                        class="name-user">{{$item->admin_id !=null? 'Tech Team' :auth()->user()->full_name}}</strong>
                                    <p>{{$item->message}}</p>
                                    <span>{{$item->created_at}}</span>
                                </div>
                            </div>

                            @endforeach

                        </div>
                        <hr>
                        <form action="{{ route('customer.profile.tickets.chat.create') }}" method="post"
                            enctype="multipart/form-data">
                            {{ csrf_field() }}
                            {{ method_field('post') }}

                            @include('partials._errors')



                            <input type="hidden" name="ticket_id" value="{{$ticket->id}}">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control" required="required" name="message" placeholder="@lang('site.message')"></textarea>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <button class="btn-started float-right">@lang('site.send') <i
                                                class="far fa-paper-plane"></i></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- //END => Profile Page -->
@endsection
