
<style>
    .box {
    display: inline-flex; /* แสดงในแนวนอน */
    align-items: center; /* จัดแนวกลางในแนวตั้ง */
    margin-top: 15px; /* ระยะห่างด้านบน */
}
body {
    height: 10%; /* ปรับให้ความสูงเป็นอัตโนมัติ */
    margin: 0; /* ลบ margin เริ่มต้น */}
#container4link {
        background-color: white; /* ให้ container มีพื้นหลังสีขาว */
        height: 100%; /* ทำให้ยืดเต็มความสูง */
    }
    
    /* @if (Laravel\Fortify\Features::canManageTwoFactorAuthentication())
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.two-factor-authentication-form')
                </div>

                <x-section-border />
            @endif -->
            <!-- <div class="mt-10 sm:mt-0">
                @livewire('profile.logout-other-browser-sessions-form')
            </div>  */

</style>
<x-app-layout>
    

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (Laravel\Fortify\Features::canUpdateProfileInformation())
                @livewire('profile.update-profile-information-form')

                <x-section-border />
            @endif

            @if (Laravel\Fortify\Features::enabled(Laravel\Fortify\Features::updatePasswords()))
                <div class="mt-10 sm:mt-0">
                    @livewire('profile.update-password-form')
                </div>

                <x-section-border />
            @endif

            

            

            <!-- @if (Laravel\Jetstream\Jetstream::hasAccountDeletionFeatures())
                <x-section-border />

                <div class="mt-10 sm:mt-0">
                    @livewire('profile.delete-user-form')
                </div>
            @endif
        </div>
    </div> -->
</x-app-layout>
