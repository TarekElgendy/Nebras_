<div>
    <form wire:submit.prevent="update">
        @if (session()->has('message'))
        <div class="alert alert-success">{{ session('message') }}</div>
        @endif
        <div class="row">
            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compName" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compName')" value="{{ old('compName', $compName) }}">
                    <label for="floatingInput"> @lang('site.compName') </label>
                    @error('compName') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compLegalName" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compLegalName')" value="{{ old('compLegalName', $compLegalName) }}">
                    <label for="floatingInput"> @lang('site.compLegalName') </label>
                    @error('compLegalName') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compemail" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compemail')" value="{{ old('compemail', $compemail) }}">
                    <label for="floatingInput"> @lang('site.compemail') </label>
                    @error('compemail') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compPhone" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compPhone')" value="{{ old('compPhone', $compPhone) }}">
                    <label for="floatingInput"> @lang('site.compPhone') </label>
                    @error('compPhone') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compWebsite" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compWebsite')" value="{{ old('compWebsite', $compWebsite) }}">
                    <label for="floatingInput"> @lang('site.compWebsite') </label>
                    @error('compWebsite') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compAddress" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compAddress')" value="{{ old('compAddress', $compAddress) }}">
                    <label for="floatingInput"> @lang('site.compAddress') </label>
                    @error('compAddress') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label"> @lang('site.compLogo')
                </label>
                <div class="input-group">
                    <input type="file" wire:model="compLogo" class="form-control" id="inputGroupFile02">
                    <label class="input-group-text" for="inputGroupFile02">@lang('site.logo') </label>
                </div>
                <span class="hint-input d-block">
                    يجب ان لا يحتوي اللوجو عن اي معلومات تواصل
                    مثل رقم الهاتف او ويب سايت
                </span>
                <img src="{{ url('uploads/users/' . $compLogo) }}" style="width: 50px" class="img-thumbnail ">
                @error('image') <span class="error">{{ $message }}</span> @enderror
            </div>
            <div class="col-12 mb-3">
                <strong>@lang('site.LegalInformation')</strong>
            </div>

            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compCommercialRecord" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compCommercialRecord')"
                        value="{{ old('compCommercialRecord', $compCommercialRecord) }}">
                    <label for="floatingInput"> @lang('site.compCommercialRecord') </label>
                    @error('compCommercialRecord') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compTaxNumber" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compTaxNumber')" value="{{ old('compTaxNumber', $compTaxNumber) }}">
                    <label for="floatingInput"> @lang('site.compTaxNumber') </label>
                    @error('compTaxNumber') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>


            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compTaxValueNumber" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compTaxValueNumber')"
                        value="{{ old('compTaxValueNumber', $compTaxValueNumber) }}">
                    <label for="floatingInput"> @lang('site.compTaxValueNumber') </label>
                    @error('compTaxValueNumber') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>


            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compIndustryRegistry" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compIndustryRegistry')"
                        value="{{ old('compIndustryRegistry', $compIndustryRegistry) }}">
                    <label for="floatingInput"> @lang('site.compIndustryRegistry') </label>
                    @error('compIndustryRegistry') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-12 mb-3">
                <strong> @lang('site.bankAccount') </strong>
            </div>

            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compBankAccount" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compBankAccount')"
                        value="{{ old('compBankAccount', $compBankAccount) }}">
                    <label for="floatingInput"> @lang('site.compBankAccount') </label>
                    @error('compBankAccount') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>


            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compBankSwift" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compBankSwift')" value="{{ old('compBankSwift', $compBankSwift) }}">
                    <label for="floatingInput"> @lang('site.compBankSwift') </label>
                    @error('compBankSwift') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compBankCity" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compBankCity')" value="{{ old('compBankCity', $compBankCity) }}">
                    <label for="floatingInput"> @lang('site.compBankCity') </label>
                    @error('compBankCity') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compBankStockholder" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compBankStockholder')"
                        value="{{ old('compBankStockholder', $compBankStockholder) }}">
                    <label for="floatingInput"> @lang('site.compBankStockholder') </label>
                    @error('compBankStockholder') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>


            <div class="col-12 mb-3">
                <strong> @lang('site.shippingAddress') </strong>
            </div>
            <div class="col-md-6 mb-4">
                <div class="form-floating">
                    <input type="text" wire:model.lazy="compShippingAddress" class="form-control" id="floatingInput"
                        placeholder="@lang('site.compShippingAddress')"
                        value="{{ old('compShippingAddress', $compShippingAddress) }}">
                    <label for="floatingInput"> @lang('site.compShippingAddress') </label>
                    @error('compShippingAddress') <span class="error">{{ $message }}</span> @enderror
                </div>
            </div>
            <div class="col-12 mb-3">
                <strong> رفع الاوراق القانونية </strong>
                <span class="hint-input d-block">
                    (يجب رفع صور اوpdf للاوراق القانونية مثل سجل
                    التجاري والصناعي والقيمة المضافة ويمكنك
                    تحميل عدة ملفات)
                </span>
            </div>
            <div class="col-12 mb-4">
                <div class="files-upload w-100">
                    <div class="file-upload">
                        <input type="file" wire:model='user_attachments' id="file" multiple
                            onchange="javascript:updateList()" />
                        <div id="fileList">
                            <ul id="list__files"></ul>
                        </div>
                        <i class="fas fa-4x mb-3 fa-cloud-upload-alt"></i>
                        <strong> قم بإختيارالملف </strong>
                        <p> يمكنك تحميل عدة ملفات دفعة واحدة
                        </p>
                        <span class="sicrit_p"> جميع التجميلات
                            أمنة وسرية </span>
                    </div>
                </div>
            </div>

            @foreach ($attachments as $item)
            <link rel="stylesheet" href="{{ url('uploads/users/files' . $item->file) }}">
            {{ $item->id }}
            <br>
            {{ $item->file }}

            @endforeach

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"> خروج </button>
            <button type="submit" class="btn btn-primary"> حفظ التعديلات
            </button>
        </div>
    </form>
</div>