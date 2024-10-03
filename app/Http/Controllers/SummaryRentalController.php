<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Type_manga;
use App\Models\Pubilsher;
use App\Models\Volume;
use App\Models\User_manga;
use App\Models\Rental_detail;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;
class SummaryRentalController extends Controller
{
    public function ConfirmRental(Request $request)
{
    // ดึงจำนวนวันเช่าจากคำขอ
    $rentalDays = $request->input('rental_days');

    // ดึง id_user_manga จากคำขอ
    $idUserManga = $request->input('id_user_manga');

    // ดึง id_volume และ total_price ที่เป็น array
    $idVolumes = $request->input('id_volume');
    $totalPrices = $request->input('total_price');

    // ดึงรายการเช่าที่มี status = 0 ของผู้ใช้
    $order = Rental::where('status', 0)
                    ->where('id_user_manga', Auth::user()->id)
                    ->first();

    // ตรวจสอบว่าพบ order หรือไม่
    if ($order) {
        // วนลูปผ่าน id_volume และ total_price เพื่ออัปเดตแต่ละรายการ
        foreach ($idVolumes as $index => $idVolume) {
            $totalPrice = $totalPrices[$index]; // ดึงราคาแต่ละเล่ม

            // อัปเดตข้อมูลในตาราง rental_details
            Rental_detail::where('id_user_manga', $idUserManga)
                        ->where('id_volume', $idVolume)
                        ->update([
                            'status' => 0 // เปลี่ยนสถานะเป็น 0
                        ]);

            // อัปเดตจำนวนใน Volume ให้เป็น 0
            Volume::where('id', $idVolume)->update(['Amount' => 0]);
        }

        // อัปเดตข้อมูลในตาราง rentals
        Rental::where('id', $order->id)
            ->update([
                'status' => 1, // เปลี่ยนสถานะเป็น 1
                'date_rent' => now(), // ใช้วันที่ปัจจุบัน
                'rental_day' => $rentalDays
            ]);

        // เปลี่ยนเส้นทางกลับไปที่หน้าอื่นพร้อมข้อความสำเร็จ
        return redirect('/HomePage')->with('success', 'การเช่าสำเร็จ');
    }

    return redirect('/HomePage')->with('error', 'ไม่พบข้อมูลการเช่า');
}
}