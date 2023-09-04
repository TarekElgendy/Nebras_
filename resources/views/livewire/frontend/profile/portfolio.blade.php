@if (session()->has('message'))
<div class="alert alert-success">{{ session('message') }}</div>
@endif
<form wire:submit.prevent="create">

    <div class="row">
        <div class="col-md-12 mb-4">
            <div class="form-floating">
                <input type="text" wire:model="title" class="form-control" id="floatingInput"
                    placeholder=" @lang('site.title') ">
                <label for="floatingInput"> @lang('site.title')
                </label>
                @error('title')
                <span class="error">{{ $message }}</span>
                @enderror
            </div>
        </div>
        <div class="col-md-12 mb-4">
            <label for="exampleFormControlTextarea1" class="form-label">
                @lang('site.image') </label>
            <div class="files-upload w-100">
                <div class="file-upload">
                    <input type="file" wire:model="image" aria-label="file" />
                    <i class="fas fa-4x mb-3 fa-cloud-upload-alt"></i>
                    <strong> @lang('site.image') </strong>
                    @error('image')
                    <span class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
        <button type="submit" class="btn btn-primary"> @lang('site.create')
        </button>
    </div>
</form>