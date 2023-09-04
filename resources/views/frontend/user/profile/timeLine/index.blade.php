@extends('layouts.user.app')
@section('title_page')
    @lang('site.timeLines')
    @php
        $page = 'timeLines';
    @endphp
@endsection
@section('content')
    <main class="bg-gray">
        <!-- START => Breadcrumb -->
    <div class="breadcrumb-page bg-white-shadow py-3">
        <div class="container">
          <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
              <li class="breadcrumb-item"><a href="{{route('user.myorders')}}"> طلباتى </a></li>
              <li class="breadcrumb-item active" aria-current="page"> {{userTagID().$offer->order_id}}</li>
            </ol>
          </nav>
        </div>
      </div>
      <!-- //END => Breadcrumb -->


        <section class="section-requ-details pb-5">
            <div class="container bg-white-shadow py-5 px-4 rounded-3">
              <div class="accordion accordion-flush" id="accordion-requests">

                @foreach ($categories as $key=>$category)
                @php
                    $timeline = App\Models\Timeline::where('page_id', $category->id)->first();
                @endphp


                <div class="accordion-item">
                  <h2 class="accordion-header" id="flush-1">
                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#tab-{{$category->id}}"
                      aria-expanded="false" aria-controls="tab-{{$category->id}}">
                      <i class="far fa-check-circle fa-lg me-2 {{$timeline?'color_done':''}} "></i>  {{$category->title}}
                    </button>
                  </h2>
                  <div id="tab-{{$category->id}}" class="accordion-collapse collapse {{$key==0?'show':''}}" aria-labelledby="flush-1"
                    data-bs-parent="#accordion-requests">
                    <div class="accordion-body">
                      <p class="mb-1"> {{$timeline->title??''}}</p>
                      <p class="mb-1"> {!! $timeline->description??'' !!}</p>
                    </div>
                  </div>
                </div>
                @endforeach

              </div>
            </div>
          </section>
    </main>
@endsection
