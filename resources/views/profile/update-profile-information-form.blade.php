<x-form-section submit="updateProfileInformation">
    <x-slot name="title"><strong style="font-size:32;">
        เปลี่ยนชื่อ และ อีเมล</strong>
    </x-slot>

    <x-slot name="description">
        
    </x-slot> 

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{photoName: null, photoPreview: null}" class="col-span-6 sm:col-span-4">
                <input type="file" class="hidden"
                            wire:model="photo"
                            x-ref="photo"
                            x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-label for="photo" value="{{ __('รูปภาพ') }}" />

                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}" class="rounded-full h-20 w-20 object-cover">
                </div>

                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                          x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('เลือกภาพใหม่') }}
                </x-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('ลบภาพ') }}
                    </x-secondary-button>
                @endif

                <x-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Name -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="name" value="{{ __('ชื่อ') }}" style="font-size:18;" />
            <x-input id="name" type="text" class="mt-1 block w-full" wire:model.defer="state.name" autocomplete="name" />
            <x-input-error for="name" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="email" value="{{ __('อีเมล') }}" style="font-size:18;"/>
            <x-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" autocomplete="username" />
            <x-input-error for="email" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="phone" value="{{ __('เบอร์โทร') }}" style="font-size:18;"/>
            <x-input id="phone" type="text" class="mt-1 block w-full" wire:model.defer="state.phone" />
            <x-input-error for="phone" class="mt-2" />
        </div>

        <!-- Address -->
        <div class="col-span-6 sm:col-span-4">
            <x-label for="address" value="{{ __('ที่อยู่') }}" style="font-size:18;"/>
            <x-input id="address" type="text" class="mt-1 block w-full" wire:model.defer="state.address" />
            <x-input-error for="address" class="mt-2" />
        </div>

        <!-- Sex -->
        <div class="col-span-6 sm:col-span-4" >
            <x-label for="sex" value="{{ __('เพศ') }}" style="font-size:18;"/>
            <select id="sex" class="mt-1 block w-full" wire:model.defer="state.sex" style="border-radius:5px;border:0.5;">
                <option value="">{{ __('เลือกเพศ') }}</option>
                <option value="male">{{ __('ชาย') }}</option>
                <option value="female">{{ __('หญิง') }}</option>
                <option value="other">{{ __('อื่นๆ') }}</option>
            </select>
            <x-input-error for="sex" class="mt-2" />
        </div>

    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('บันทึกสำเร็จ') }}
        </x-action-message>

        <x-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('บันทึก') }}
        </x-button>
    </x-slot>
</x-form-section>
