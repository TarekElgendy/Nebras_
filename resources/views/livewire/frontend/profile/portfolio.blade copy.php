<div class="tab-pane " id="works" role="tabpanel" aria-labelledby="disabled-tab" tabindex="0">
    <div class="table_style">
        <!-- Table Head -->
        <div class="row g-0 row_header align-items-center">
            <div class="col-md-12 d-flex align-items-center px-3 justify-content-between">
                <strong class="me-auto">{{ userTagID() }}-{{ auth()->user()->id }} </strong>
                <a href="{{ route('user.portfolio.create') }}" class="style-btn mt-2 mb-2 ">
                    <i class="fas fa-plus"></i> @lang('site.add') </a>
                <div class="modal " id="addWorks" tabindex="-1" aria-labelledby="addWorksLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title"> @lang('site.add')
                                    @lang('site.portfolio') </h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">

                                <form wire:submit.prevent="create" enctype="multipart/form-data" class="px-lg-4 px-md-4 p-">
                                    @if (session()->has('message'))
                                    <div class="alert alert-success">{{ session('message') }}</div>
                                    @endif
                                    <div class="row">
                                        <div class="col-md-12 mb-4">
                                            <div class="form-floating">

                                                <input type="text" wire:model="title" class="form-control" id="floatingInput" placeholder=" @lang('site.title') ">
                                                <label for="floatingInput"> @lang('site.title')
                                                </label>
                                                @error('title') <span class="error">{{ $message }}</span> @enderror

                                            </div>
                                        </div>

                                        <div class="col-md-12 mb-4">
                                            <label for="exampleFormControlTextarea1" class="form-label">
                                                @lang('site.image') </label>
                                            <div class="files-upload w-100">
                                                <div class="file-upload">
                                                    <input type="file" required="required" wire:model="image" aria-label="file" />
                                                    <i class="fas fa-4x mb-3 fa-cloud-upload-alt"></i>
                                                    <strong> @lang('site.image') </strong>
                                                    @error('image') <span class="error">{{ $message }}</span> @enderror
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" wire:click="$emit('refreshComponent')" class="btn btn-secondary" data-bs-dismiss="modal">
                                            @lang('site.cancel') </button>


                                        <button type="submit" class="btn btn-primary"> @lang('site.create')
                                        </button>
                                    </div>
                                </form>



                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ##END Table Head -->


        <div class="row py-4 px-3 g-4">

            @foreach ($portfolios as $item)

            <div class="col-md-4">
                <div class="item-work bg-white-shadow rounded-3">
                    <a href="{{ route('user.portfolio.delete',$item->id) }}" type="button" class="edit-btn style-btn" aria-label="edit"> <i class=" fa fa-fw fa-trash"></i>
                        @lang('site.delete')
                    </a>
                    <div class="img_work">
                        <img src="{{$item->image_path}}" class="img-fluid" alt="work">
                        <a href="{{$item->image_path}}" class="zoom-link" data-fancybox="gallery" aria-label="zoom">
                            <i class="fas fa-search"></i>
                        </a>
                    </div>
                    <a href="" class="link"> {{$item->title}} </a>
                </div>
            </div>

            @endforeach

        </div>

    </div>

</div>