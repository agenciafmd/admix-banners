<x-page.form
        title="{{ $banner->exists ? __('Update :name', ['name' => __(config('admix-banners.name'))]) : __('Create :name', ['name' => __(config('admix-banners.name'))]) }}">
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.label
                    for="form.is_active">
                {{ str(__('admix-banners::fields.is_active'))->ucfirst() }}
            </x-form.label>
            <x-form.toggle
                    name="form.is_active"
                    :large="true"
                    :label-on="__('Yes')"
                    :label-off="__('No')"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.label>
                {{ str(__('admix-banners::fields.star'))->ucfirst() }}
            </x-form.label>
            <x-form.toggle
                    name="form.star"
                    :large="true"
                    :label-on="__('Yes')"
                    :label-off="__('No')"
            />
        </div>
    </div>
    <div class="row">
        <div class="col-md-6 mb-3">
            <x-form.input
                    name="form.name"
                    :label="__('admix-banners::fields.name')"
            />
        </div>
        <div class="col-md-6 mb-3">
        </div>
        <div class="col-md-12 mb-3">
            <x-form.image
                    name="form.desktop"
                    :label="__('admix-banners::fields.desktop')"
                    :hide-content="!config('admix-banners.locations.' . $location . '.files.desktop.show_meta')"
                    :hide-crop="!config('admix-banners.locations.' . $location . '.files.desktop.crop_config')"
                    :crop-config="config('admix-banners.locations.' . $location . '.files.desktop.crop_config')"
                    :full-width="true"
            />
        </div>
        <div class="col-md-12 mb-3">
            <x-form.image
                    name="form.notebook"
                    :label="__('admix-banners::fields.notebook')"
                    :hide-content="!config('admix-banners.locations.' . $location . '.files.notebook.show_meta')"
                    :hide-crop="!config('admix-banners.locations.' . $location . '.files.notebook.crop_config')"
                    :crop-config="config('admix-banners.locations.' . $location . '.files.notebook.crop_config')"
                    :full-width="true"
            />
        </div>
        <div class="col-md-12 mb-3">
            <x-form.image
                    name="form.mobile"
                    :label="__('admix-banners::fields.mobile')"
                    :hide-content="!config('admix-banners.locations.' . $location . '.files.mobile.show_meta')"
                    :hide-crop="!config('admix-banners.locations.' . $location . '.files.mobile.crop_config')"
                    :crop-config="config('admix-banners.locations.' . $location . '.files.mobile.crop_config')"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.input
                    name="form.link"
                    :label="__('admix-banners::fields.link')"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.select
                    name="form.target"
                    :label="__('admix-banners::fields.target')"
                    :options="$targetOptions"/>
        </div>
        <div class="col-md-6 mb-3">
            <x-form.datetime
                    name="form.published_at"
                    :label="__('admix-banners::fields.published_at')"
            />
        </div>
        <div class="col-md-6 mb-3">
            <x-form.datetime
                    name="form.until_then"
                    :label="__('admix-banners::fields.until_then')"
            />
        </div>
    </div>

    <x-slot:complement>
        @if($banner->exists)
            <div class="mb-3">
                <x-form.plaintext
                        :label="__('admix::fields.id')"
                        :value="$banner->id"
                />
            </div>
            <div class="mb-3">
                <x-form.plaintext
                        :label="__('admix::fields.slug')"
                        :value="$banner->slug"
                />
            </div>
            <div class="mb-3">
                <x-form.plaintext
                        :label="__('admix::fields.created_at')"
                        :value="$banner->created_at->format(config('admix.timestamp.format'))"
                />
            </div>
            <div class="mb-3">
                <x-form.plaintext
                        :label="__('admix::fields.updated_at')"
                        :value="$banner->updated_at->format(config('admix.timestamp.format'))"
                />
            </div>
        @endif
    </x-slot:complement>
</x-page.form>
