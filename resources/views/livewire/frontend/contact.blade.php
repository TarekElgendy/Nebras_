<form wire:submit.prevent="submit" class="px-lg-4 px-md-4 p-2">
    @if (session('message'))
    <i class="fab fa-2x fa fa-check-circle-o"></i> <bdi>
        <br>
        {{ session('message') }}
        @endif
        <div class="row">
            <div class="col-md-12 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model="name" class="form-control" placeholder=" @lang('site.name') ">
                    <label for="floatingInput"> @lang('site.name') </label>
                    @error('name')
                    <span style="color: red" class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-floating">
                    <input type="number" wire:model="phone" class="form-control" placeholder=" @lang('site.phone') ">
                    <label for="floatingInput"> @lang('site.phone') </label>
                    @error('phone')
                    <span style="color: red" class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-floating">
                    <input type="email" wire:model="email" class="form-control" placeholder=" @lang('site.email') ">
                    <label for="floatingInput"> @lang('site.email') </label>
                    @error('email')
                    <span style="color: red" class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-12 mb-4">
                <div class="form-floating">
                    <textarea class="form-control" wire:model="message" id="floatingInput"
                        placeholder=" @lang('site.message') "></textarea>
                    <label for="floatingInput"> @lang('site.message') </label>
                    @error('message')
                    <span style="color: red" class="error">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class=" style-btn mt-2 py-3 px-5"><span> @lang('site.send')
                </span></button>

        </div>

</form>
