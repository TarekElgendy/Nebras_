<form wire:submit.prevent="update" enctype="multipart/form-data" class="px-lg-4 px-md-4 p-2">
    @if (session()->has('message'))
    <div class="alert alert-success">{{ session('message') }}</div>
    @endif
    <div class="row">
        <div class="col-md-6 file_style w-100">
            <div class="input-group mb-3">
                <label class="input-group-text" for="inputGroupFile01"> @lang('site.image') </label>
                <input type="file" wire:model="image" class="form-control" id="inputGroupFile01">
                <img src="{{ url('uploads/users/' . $currentImage) }}" style="width: 50px" class="img-thumbnail ">
                @error('image') <span class="error">{{ $message }}</span> @enderror

            </div>
        </div>


        <div class="col-md-12 mb-4">
            <div class="form-floating">
                <input type="text" wire:model.lazy="name" class="form-control" id="floatingInput"
                    placeholder="@lang('site.name')" value="{{ old('name', $name) }}">
                <label for="floatingInput"> @lang('site.name') </label>
                @error('name') <span class="error">{{ $message }}</span> @enderror
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <label for="exampleFormControlTextarea1" class="form-label"> @lang('site.compBio') </label>
            <textarea wire:model.lazy="compBio" class="form-control text-start" id="exampleFormControlTextarea1"
                rows="3" placeholder=" @lang('site.compBio') ">{{ $compBio }}</textarea>
            @error('compBio') <span class="error">{{ $message }}</span> @enderror
        </div>
        <div class="col-md-12 mb-4">
            <label for="exampleFormControlTextarea1" class="form-label"> @lang('site.compInfo1') </label>
            <textarea wire:model.lazy="compInfo1" class="form-control text-start" id="exampleFormControlTextarea1"
                rows="3" placeholder=" @lang('site.compInfo1') ">{{ $compInfo1 }}</textarea>
            @error('compInfo1') <span class="error">{{ $message }}</span> @enderror
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> @lang('site.exite')
        </button>
        <button type="sumbit" class="btn btn-primary"> @lang('site.edit') </button>
    </div>
</form>