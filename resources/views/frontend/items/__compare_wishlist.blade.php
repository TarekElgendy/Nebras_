<a href="{{route('user.comparison.create',['id'=>encodeId($product->id)])}}" data-bs-toggle="tooltip" data-bs-placement="top"
title="@lang('site.AddToCompare')"><i class="fas fa-arrows-rotate"></i></a>


<a href="{{route('user.wishlist.create',['id'=>encodeId($product->id)])}}" data-bs-toggle="tooltip" data-bs-placement="top"
title="@lang('site.AddToFavourite')" ><i class="far fa-heart " ></i></a>
