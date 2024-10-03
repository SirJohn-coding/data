<?php


namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Rental_detail;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class HistoryRentalController extends Controller
{
    public function history() {
        if (Auth::check()) {
            $userId = Auth::user()->id; // ดึง id ของผู้ใช้ที่ล็อกอิน
    
            // ดึงข้อมูลจาก rental_details ที่ id_user_manga ตรงกับผู้ใช้ที่ล็อกอิน และ status = 0
            $orderDetails = Rental_detail::where('id_user_manga', $userId)
                            ->where('status', 0)
                            ->with('volume')
                            ->get()
                            ->groupBy('id_rental');
    
            // ส่งข้อมูลไปยัง view เพื่อแสดง
            return view('history_rentals', compact('orderDetails'));
        } else {
            // ถ้าไม่มีผู้ใช้ล็อกอินให้ redirect ไปที่หน้า login
            return redirect()->route('login')->with('error', 'กรุณาเข้าสู่ระบบก่อน');
        }
    }
    
}
