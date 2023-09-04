@extends('layouts.app')
@section('title_page')
@lang('site.order now')
@php
$page = 'quote';
@endphp
@endsection
@section('des_seo')
@endsection
@section('key_seo')
@endsection
@section('content')
<main class="bg-gray">
    <!-- START => Breadcrumb -->
    <div class="breadcrumb-page bg-white-shadow py-3">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}"> @lang('site.home') </a></li>
                    <li class="breadcrumb-item"><a href="{{ route('services') }}"> @lang('site.services') </a></li>
                    <li class="breadcrumb-item"><a
                            href="{{ route('productItems', ['id' => $product->id, 'slug' => make_slug($product->title)]) }}">
                            {{ $product->title ?? '' }} </a>
                    <li class="breadcrumb-item"><a href="#"> @lang('site.order now') </a>
                </ol>
            </nav>
        </div>
    </div>
    <!-- //END => Breadcrumb -->
    <!-- START => about intro -->
    <div class="container pb-5">
        <div class="service-req-info bg-white-shadow py-2 px-4">
            <div class="row align-items-center">
                <div class="col-lg-4 col-12">
                    <img src="{{ $product->image_path }}" alt="{{ $product->title }}"
                        class="serviceimg img-fluid d-block ms-auto">
                </div>
                <div class="col-lg-8 col-12">
                    <div class="section-title mb-5">
                        <strong class="h1 fw-bold"> {{ $product->title }} </strong>
                        <div class="bar-main">
                            <div class="bar bar-big m-0"></div>
                        </div>
                    </div>
                    <p>
                        {!! $product->description !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="form-req bg-white-shadow mt-4">
            <div class="section-title text-center mb-5">
                <strong class="h3 fw-bold"> @lang('site.requestQuote')</strong>
                <div class="bar-main">
                    <div class="bar bar-big"></div>
                </div>
            </div>
            @if(Auth::check())

            <form method="post" enctype="multipart/form-data" action="{{ route('user.createOrder') }}">
                {{ csrf_field() }}
                {{ method_field('post') }}
                <div class="row">
                    <div class="col-12 mb-5">
                        <div class="files-upload">
                            <div class="file-upload">
                                <input type="file" id="file" required="required" multiple onchange="javascript:updateList()"
                                 name="order_attachments[]"

                                />
                                <div id="fileList">
                                    <ul id="list__files"></ul>
                                </div>
                                <i class="fas fa-4x mb-3 fa-cloud-upload-alt"></i>
                                <strong> قم بإختيارالملف </strong>
                                <p> يمكنك تحميل عدة ملفات دفعة واحدة </p>
                                <span>
                                    STEP, STP, SLDPRT, STL, SAT, 3DXML, 3MF, PRT, IPT, CATPART, X_T, PTC, X_B, DXF
                                    <br> DWS, DWF, DWG, PDF </span>
                                <!-- <span class="sicrit_p"> جميع التجميلات أمنة وسرية </span> -->
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input type="text" class="form-control" required="required" value="{{old('orderTitle')}}"  name="orderTitle"  id="floatingInput" placeholder="@lang('site.orderTitle') ">
                            <label for="floatingInput"> @lang('site.orderTitle') </label>
                            @error('orderTitle')<span style="color: red" class="error">{{ $message }}</span>@enderror
                            <span class="hint-input">
                                ان لم يكن لديك اسم للقطعة قم بوصفها بخمس كلمات علي الاكثر
                            </span>
                        </div>
                    </div>

                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <input type="number" required="required" name="quantity" value="{{old('quantity')}}" class="form-control" id="floatingInput" placeholder=" @lang('site.quantity')  ">
                            <label for="floatingInput"> @lang('site.quantity') </label>
                            @error('quantity')<span style="color: red" class="error">{{ $message }}</span>@enderror

                        </div>
                    </div>
                  <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <select class="form-select select-multiple w-100" name="material[]"  id="floatingSelect2" multiple
                                title=" الخامة   ">
                                @foreach ($majorCategories as $item)
                                <option disabled  >  {{$item->title}}</option>
                                @foreach ($item->majors as $major)

                                <option value="{{$major->title}}"> {{$major->title}}</option>
                                @endforeach

                                @endforeach
                            </select>
                            <label for="floatingInput">الخامة  </label>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <select class="form-select select-multiple w-100" required="required"  name="productItem_ids[]" id="floatingSelect" multiple
                                title=" طريقة التصنيع  ">
                                @foreach ($productItems as $item)

                                <option value="{{$item->id}}"> {{$item->title}}</option>
                                @endforeach
                            </select>
                            <label for="floatingInput"> طريقة التصنيع </label>
                        </div>
                    </div>

                     <div class="col-md-6 mb-4">
                        <div class="form-floating">
                            <select class="form-select select-multiple w-100" name="finishesAndPaints[]"  id="floatingSelect3" multiple
                                title=" التشطيب والطلاء  ">
                                @foreach ($finishesAndPaints as $item)

                                <option value="{{$item->title}}"> {{$item->title}}</option>
                                @endforeach
                            </select>
                            <label for="floatingInput">التشطيب والطلاء  </label>
                        </div>
                    </div>

                    <div class="col-md-6 has_peaces_image d-block mb-4">
                        <div class="input-group">
                            <label class="input-group-text" required="required" for="inputGroupFile01"> أضف صورة المنتج </label>
                            <input type="file" name="image" class="form-control" id="inputGroupFile01">
                            @error('image') <span class="error">{{ $message }}</span> @enderror
                        </div>
                        <span class="hint-input">
                            ان لم يكن لديك صور حقيقية للقطعة قم بوضع صور اسكرين من الرسم الثنائى او الثلاثى الأبعاد
                        </span>
                    </div>
                    <div class="col-md-12 mb-4">
                        <fieldset class="row">
                            <legend class="col-form-label col-sm-2 pt-0"> هل توجد لديك عينة </legend>
                            <div class="col-sm-10 d-flex">
                                <div class="form-check me-4">
                                    <input class="form-check-input" required="required" {{old('haveSample')=='yes'?'checked':''}} type="radio" name="haveSample" id="yes-1" value="yes">
                                    <label class="form-check-label" for="yes-1">
                                        نعم يوجد
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" required="required" {{old('haveSample')=='no'?'checked':''}}  type="radio" name="haveSample" id="no-1" value="no">
                                    <label class="form-check-label" for="no-1">
                                        لايوجد
                                    </label>
                                </div>
                            @error('haveSample')<span style="color: red" class="error">{{ $message }}</span>@enderror

                            </div>
                        </fieldset>
                    </div>

                    <div class="col-md-12 mb-4">
                        <div class="form-floating">
                            <textarea class="form-control" name="note" placeholder="Leave a comment here"
                                id="floatingTextarea"> {{old('note')}}</textarea>
                            <label for="floatingTextarea"> @lang('site.notes') </label>
                            @error('note')<span style="color: red" class="error">{{ $message }}</span>@enderror

                        </div>
                        <span class="hint-input">
                            مثل التفاصيل الهامة او الاشتراطات او طريقة التصنيع او اى معلومات اخرى ، مع مراعاة كتابتها فى
                            مجموعة نقاط
                            مرقمة
                        </span>
                    </div>
                </div>
                <div class="text-center">
                    <button type="submit" class="style-btn mt-2 py-3 px-5"> أطلب الأن </button>
                </div>
            </form>
            @else
            @include('partials._loginAtFirst')
            @endif
        </div>
    </div>
    <!-- //END => about intro -->
</main>
@endsection
