<x-form-section submit="updatePassword">
    <x-slot name="title" >
       <strong style="font-size:32;"> เปลี่ยนรหัสผ่าน </strong>
    </x-slot>

    <x-slot name="description">
    </x-slot>

    <x-slot name="form">
        <div class="col-span-6 sm:col-span-4">
            <x-label for="current_password" value="{{ __('รหัสผ่านปัจจุบัน') }}" style="font-size:18;"/>
            <x-input id="current_password" type="password" class="mt-1 block w-full" wire:model.defer="state.current_password" autocomplete="current-password" />
            <x-input-error for="current_password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password" value="{{ __('รหัสผ่านใหม่') }}" style="font-size:18;"/>
            <x-input id="password" type="password" class="mt-1 block w-full" wire:model.defer="state.password" autocomplete="new-password" />
            <x-input-error for="password" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4">
            <x-label for="password_confirmation" value="{{ __('ยืนยันรหัสผ่าน') }}" style="font-size:18;"/>
            <x-input id="password_confirmation" type="password" class="mt-1 block w-full" wire:model.defer="state.password_confirmation" autocomplete="new-password" />
            <x-input-error for="password_confirmation" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-action-message class="mr-3" on="saved">
            {{ __('บันทึกสำเร็จ') }}
        </x-action-message>

        <x-button>
            {{ __('บันทึก') }}
        </x-button>
    </x-slot>
</x-form-section>
