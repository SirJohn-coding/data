<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use App\Models\User;
use Illuminate\Validation\ValidationException;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);


        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())) . '|' . $request->ip());

            return Limit::perMinute(5)->by($throttleKey);
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
        Fortify::authenticateUsing(function (Request $request) {
            // ค้นหาผู้ใช้จากอีเมล
            $user = User::where('email', $request->email)->first();

            // ตรวจสอบว่าผู้ใช้มีสถานะ status เป็น 0 หรือไม่
            if ($user && $user->status == 0) {
                // ถ้าสถานะเป็น 0 ปฏิเสธการเข้าสู่ระบบพร้อมแสดงข้อความ
                throw ValidationException::withMessages([
                    Fortify::username() => ['บัญชีนี้ถูกระงับการใช้งาน.'],
                ]);
            }

            // ถ้าสถานะไม่ใช่ 0 ให้ตรวจสอบรหัสผ่าน
            if ($user && Hash::check($request->password, $user->password)) {
                return $user;
            }

            // ถ้ารหัสผ่านหรือผู้ใช้ไม่ถูกต้อง จะคืนค่า null โดย Fortify จะจัดการเอง
            return null;
        });
    }
}
