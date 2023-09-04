<div class="bg-white-shadow mb-3 p-3">
    <strong class="d-block h6 mb-3"> نبذة عنى </strong>
    <p>
        {{ auth()->user()->profile->compBio }}
    </p>
</div>
<div class="bg-white-shadow mb-3 p-3">
    <strong class="d-block h6 mb-3"> معدات لدى المصنع </strong>
    <p>
        {{ auth()->user()->profile->compInfo1 }}
    </p>
</div>
<div class="specialists bg-white-shadow mb-3 p-3">
    <strong class="d-block h6 mb-3"> تخصصاتى </strong>
    <div class="d-flex flex-wrap">
        <span class="b-black mb-2 rounded-5 mx-1 small py-2 px-3"> أدوات التصنيع </span>
        <span class="b-black mb-2 b-gray rounded-5 mx-1 small py-2 px-3"> التصنيع
            باستخدام الحاسب الآلي
            العام </span>
        <span class="b-black mb-2 b-orange rounded-5 mx-1 small py-2 px-3"> الإنجليزية
        </span>
        <span class="b-black mb-2 b-blue rounded-5 mx-1 small py-2 px-3"> 1 أو أكثر من
            موظفي مراقبة الجودة
        </span>
    </div>
</div>
