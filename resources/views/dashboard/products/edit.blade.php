@extends('layouts.dashboard.app')
<?php
$page = 'products';
$title = trans('dash.products');
?>
@section('title_page')
    {{ $title }}
@endsection
@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <h1>{{ $title }}</h1>
            <ol class="breadcrumb">
                <li><a href="{{ route('dashboard.index') }}"><i class="fa fa-dashboard"></i> @lang('site.Dashboard')</a></li>
                <li><a href="{{ route('dashboard.products.index') }}"> @lang('site.section')</a></li>
                <li class="active">@lang('site.edit')</li>
            </ol>
        </section>
        <section class="content">
            <div class="">
                {{-- <div class="box-header">
                <h3 class="box-title">@lang('site.edit')</h3>
            </div><!-- end of box header -->
            --}}
                <div class="box-body">
                    @include('partials._errors')
                    <form action="{{ route('dashboard.products.update', $product->id) }}" method="post"
                        enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('put') }}
                        <div class="col-md-4">
                            <!-- /one -->
                            <div class="box box-primary ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>SITE</strong> INFO</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">




                                        @foreach (config('translatable.locales') as $key => $locale)
                                            <div class="form-group">
                                                <span class="label label-warning  ">{{ $key + 1 }} </span>
                                                <label>@lang('dash.' . $locale . '.title_site')</label>
                                                <input type="text" name="{{ $locale }}[title]" class="form-control"
                                                    value="{{ $product->translate($locale)->title }}">
                                            </div>


                                            <div class="form-group">
                                                <label>@lang('dash.' . $locale . '.short_description')</label>
                                                <textarea name="{{ $locale }}[short_description]" id="" class="form-control" cols="30"
                                                    rows="5">{{ $product->translate($locale)->short_description }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('dash.' . $locale . '.description')</label>
                                                <textarea name="{{ $locale }}[description]" id="" class="form-control summernote" cols="30"
                                                    rows="5">{{ $product->translate($locale)->description }}</textarea>
                                            </div>
                                            <div class="  with-border"></div><br>
                                        @endforeach

                                        <div class="form-group col-md-6">
                                            <label>@lang('dash.length')</label>
                                            <input type="text" min="0" step="0.01"  name="length" class="form-control"
                                                value="{{  $product->length }}">
                                        </div>

                                        <div class="form-group col-md-6">
                                            <label>@lang('dash.width')</label>
                                            <input type="text" min="0" step="0.01"  name="width" class="form-control"
                                                value="{{ $product->width }}">
                                        </div>


                                   <div class="form-group col-md-6">
                                            <label>@lang('dash.height')</label>
                                            <input type="text" min="0" step="0.01"  name="height" class="form-control"
                                                value="{{  $product->height}}">
                                        </div>

                                   <div class="form-group col-md-6">
                                            <label>@lang('dash.weight')</label>
                                            <input type="text" min="0" step="0.01"  name="weight" class="form-control"
                                                value="{{  $product->weight }}">
                                        </div>




                                    </div>
                                </div>
                            </div>
                        </div>{{-- end col md  --}}
                        <div class="col-md-4">
                            <!-- /one -->
                            <div class="box box-success ">
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>SITE</strong> Data</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label>@lang('dash.price')</label>
                                            <input type="number" required="required" name="price" class="form-control"
                                                value="{{  $product->price }}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('dash.old_price')</label>
                                            <input type="number"  name="old_price" class="form-control"
                                                value="{{  $product->old_price }}">
                                        </div>

                                    {{-- -------------- --}}

                                        <div class="form-group">
                                            <label>@lang('dash.stock')</label>
                                            <input type="number"  name="stock" class="form-control"
                                                value="{{ $product->stock  }}">
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('dash.stock_availability') </label>
                                            <select name="stock_availability" required="required" class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"  {{   $product->stock_availability==$item?'selected':'' }}> {{ __('dash.' . $item) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>@lang('dash.warranty')</label>
                                            <select name="warranty" required="required" class="form-control"
                                                id="warrantySelect">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ $product->warranty  == $item ? 'selected' : '' }}>
                                                        {{ __('dash.' . $item) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group" id="warrantyInfoDiv">
                                            <label>@lang('dash.warrantyInfo')</label>
                                            <input type="text" name="warrantyInfo" class="form-control"
                                                value="{{ $product->warrantyInfo}}">
                                        </div>
                                        <div class="form-group">
                                            <label>@lang('dash.Refundable') </label>
                                            <select name="Refundable" required="required" class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"  {{   $product->Refundable==$item?'selected':'' }}> {{ __('dash.' . $item) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('dash.taxesIncluded') </label>
                                            <select name="taxesIncluded" required="required" class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"  {{   $product->taxesIncluded==$item?'selected':'' }}> {{ __('dash.' . $item) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>


                                        <div class="form-group">
                                            <label>@lang('dash.availableColors') </label>
                                            <select name="availableColors" required="required" class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                <option value="oneColor"  {{   $product->availableColors=="oneColor"?'selected':'' }}>oneColor</option>
                                                <option value="multiple"  {{   $product->availableColors=="multiple"?'selected':'' }}>multiple Color</option>
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('dash.poweredBy') </label>
                                            <select name="poweredBy" required="required" class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach (poweredBy() as $item)
                                                    <option value="{{ $item }}"  {{   $product->poweredBy==$item?'selected':'' }}> {{ __('dash.' . $item) }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('dash.manufacturerCountry')</label>
                                            <input type="text" name="manufacturerCountry" class="form-control"
                                                value="{{   $product->manufacturerCountry }}">
                                        </div>





                                 {{-- -------------- --}}

                                        <div class="form-group">
                                            <label>@lang('dash.brands') </label>
                                            <select name="brand_id"  class="form-control">
                                                <option value="">@lang('dash.select')</option>
                                                @foreach ($brands as $item)
                                                    <option value="{{ $item->id }}"  {{  $product->brand_id==$item->id?'selected':'' }}> {{ $item->title }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label>@lang('dash.categories') </label>

                                            @foreach ($product->categories as $category)
                                            <div class="form-check">
                                                <input class="form-check-input"  name="category_id[]" type="checkbox"  checked  value="{{ $category->id }}" id="{{ $category->id }}">
                                                <label class="form-check-label" for="{{ $category->id }}">
                                                    {{ $category->title }}
                                                </label>
                                              </div>
                                        @endforeach
                                        @foreach ($unselectedCategories as $item)
                                        <div class="form-check">
                                            <input class="form-check-input"  name="category_id[]" type="checkbox"  value="{{ $item->id }}" id="{{ $item->id }}">
                                            <label class="form-check-label" for="{{ $item->id }}">
                                                {{ $item->title }}
                                            </label>
                                          </div>
                                        @endforeach



                                        </div>





                                        <div class="  with-border"></div><br>

                                    </div>
                                </div>
                            </div>

                            <!-- /one -->

                        </div>{{-- end col md  --}}

                        <div class="col-md-4">
                            <!-- /one -->
                            <div class="box box-danger ">
                                <div class="box box-danger ">
                                    <div class="box-header with-border">
                                        <h3 class="box-title"><strong>SITE</strong> DISPLAY</h3>
                                    </div>
                                    <!-- /.box-header -->
                                    <div class="box-body ">
                                        <div class="panel-body">
                                            <div class="form-group">
                                                <label>@lang('dash.status') </label>
                                                <select name="status" required="required" class="form-control">
                                                    <option value="">@lang('dash.select')</option>
                                                    @foreach (activeOrinactive() as $item)
                                                        <option value="{{ $item }}"
                                                            {{ $product->status == $item ? 'selected' : '' }}>
                                                            {{ __('dash.' . $item) }}

                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label>@lang('dash.mainPage') </label>
                                                <select name="mainPage" required="required" class="form-control">
                                                    <option value="">@lang('dash.select')</option>
                                                    @foreach (activeOrinactive() as $item)
                                                        <option value="{{ $item }}"
                                                            {{ $product->status == $item ? 'selected' : '' }}>
                                                            {{ __('dash.' . $item) }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>

{{--
                                            <div class="form-group">
                                                <label> @lang('site.isInside') @lang('dash.exclusive') ؟ </label>
                                                <select name="exclusive" required="required" class="form-control">
                                                    <option value="">@lang('dash.select')</option>
                                                    @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ $product->exclusive == $item ? 'selected' : '' }}>
                                                        {{ __('dash.' . $item) }}

                                                    </option>
                                                @endforeach

                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label> @lang('site.isInside')  @lang('dash.feature') ؟ </label>
                                                <select name="feature" required="required" class="form-control">
                                                    <option value="">@lang('dash.select')</option>
                                                    @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ $product->feature == $item ? 'selected' : '' }}>
                                                        {{ __('dash.' . $item) }}

                                                    </option>
                                                @endforeach

                                                </select>
                                            </div>

                                            <div class="form-group">
                                                <label> @lang('site.isInside')  @lang('dash.offer') ؟ </label>
                                                <select name="offers" required="required" class="form-control">
                                                    <option value="">@lang('dash.select')</option>
                                                    @foreach (activeOrinactive() as $item)
                                                    <option value="{{ $item }}"
                                                        {{ $product->offers == $item ? 'selected' : '' }}>
                                                        {{ __('dash.' . $item) }}

                                                    </option>
                                                @endforeach

                                                </select>
                                            </div> --}}

                                            <div class="form-group">
                                                <label>@lang('dash.link')</label>
                                                <input type="text" name="link" class="form-control"
                                                    value="{{ $product->link }}">
                                            </div>

                                            <div class="form-group">
                                                <label>@lang('dash.rank')</label>
                                                <input type="number" name="rank" class="form-control"
                                                    value="{{ $product->rank }}">
                                            </div>


                                            <div class="form-group">
                                                <label>@lang('dash.image') Front </label>
                                                <input type="file" name="icon" class="form-control image3"
                                                    enctype="multipart/form-data">
                                                <small class="tiny-message">{{ recommendDimension($page, 'icon') }}</small>
                                            </div>
                                            <div class="form-group">
                                                <img src="{{ $product->icon_path }}" style="width: 100px"
                                                    class="img-thumbnail image-preview3" alt="">
                                            </div>

                                            <div class="form-group">
                                                <label>@lang('dash.image') Back </label>
                                                <input type="file" name="image" class="form-control image"
                                                    enctype="multipart/form-data">
                                                <small class="tiny-message"> {{ recommendDimension($page, 'image') }}</small>
                                            </div>
                                            <div class="form-group">
                                                <img src="{{ $product->image_path }}" style="width: 100px"
                                                    class="img-thumbnail image-preview" alt="">
                                            </div>


                                            <div class="form-group">
                                                <label for="files">@lang('site.images')</label>
                                                <input type="file" multiple name="images[]" class="form-control image2" id="gallery-photo-add">
                                                    <br>
                                                @foreach ($product->files as $item)
                                                <a href="{{route('dashboard.products.image_delete',['id'=>$item->id])}}"
                                                    onclick="return confirm('{{trans('site.confirm_delete')}}')"
                                                    class="confirm btn btn-danger img-thumbnail image-preview2x" style="width: 100px; " title="Delete this item">
                                                    <i class="fa fa-trash"></i><br>
                                                    <img src="{{$item->image_path}}" class="img-thumbnail image-preview2x"
                                                        alt="">
                                                </a>
                                                @endforeach
                                                <div class="gallery">
                                                </div>

                                            </div>


                                            <div class="  with-border"></div><br>

                                        </div>
                                    </div>
                                </div>
                                <div class="box-header with-border">
                                    <h3 class="box-title"><strong>@lang('dash.side')</strong> @lang('dash.SEO')</h3>
                                </div>
                                <!-- /.box-header -->
                                <div class="box-body ">
                                    <div class="panel-body">
                                        @foreach (config('translatable.locales') as $key => $locale)
                                            <div class="form-group">
                                                <span
                                                    class="label label-{{ $key % 2 == 0 ? 'warning' : 'danger' }}  ">{{ $locale }}
                                                </span>

                                                <label>@lang('site.' . $locale . '.seo_key')</label>
                                                <input type="text" name="{{ $locale }}[seo_key]"
                                                    class="form-control tag" value="{{ $product->translate($locale)->seo_key  }}">
                                            </div>
                                            <div class="form-group">
                                                <label>@lang('site.' . $locale . '.seo_des')</label>
                                                <textarea name="{{ $locale }}[seo_des]" id="" class="form-control" cols="30" rows="5">{{ $product->translate($locale)->seo_des   }}</textarea>
                                            </div>
                                            <div class="  with-border"></div><br>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>{{-- end col md  --}}

                        <div class="col-md-12">

                            <div class="form-group ">
                                <button type="submit" class="btn btn-primary col-md-12"><i class="fa fa-edit"></i>
                                    @lang('site.edit')</button>
                            </div>
                        </div>

                    </form><!-- end of form -->
                </div><!-- end of box body -->
            </div><!-- end of box -->
        </section><!-- end of content -->
    </div><!-- end of content wrapper -->



    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const warrantySelect = document.getElementById("warrantySelect");
            const warrantyInfoDiv = document.getElementById("warrantyInfoDiv");

            warrantySelect.addEventListener("change", function() {
                if (warrantySelect.value === "active") {
                    warrantyInfoDiv.style.display = "block";
                } else {
                    warrantyInfoDiv.style.display = "none";
                }
            });

            // Trigger initial check based on the default value
            if (warrantySelect.value === "active") {
                warrantyInfoDiv.style.display = "block";
            } else {
                warrantyInfoDiv.style.display = "none";
            }
        });
    </script>
@endsection
