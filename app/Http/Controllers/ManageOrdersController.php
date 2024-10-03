<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Volume;
use App\Models\Rental_detail;
use App\Models\User;

use Carbon\Carbon; // ใช้สำหรับการจัดการวันที่

class ManageOrdersController extends Controller
{
    public function Home_ManageOrders()
    {
        $limitDate = Carbon::now()->subDays(3);
        // ดึงข้อมูลคำสั่งเช่าที่หมดอายุ
        $expiredRentals = Rental::where('date_rent', '<', $limitDate)
            ->where('rwn_status', 1)
            ->get();

        // อัพเดตสถานะคำสั่งเช่าที่หมดอายุ
        foreach ($expiredRentals as $rental) {
            $rental->rwn_status = 2;
            $rental->save(); // บันทึกการเปลี่ยนแปลง
        }

        $rentals = Rental::whereNull('deleted_at')->get(); // ดึงข้อมูลคำสั่งเช่าทั้งหมดจากฐานข้อมูล
        

        return view('ManageOrders', compact('rentals'));
    }




    public function Search_Orders(Request $request)
    {
        // รับค่าจากฟอร์ม
        $searchId = $request->input('searchid');
        $status = $request->input('status');

        // เริ่มต้นการค้นหา
        $query = Rental::whereNull('deleted_at'); 

        // หากมีการกรอก ID คำสั่งเช่า
        if ($searchId) {
            $query->where('id', $searchId);
        }

        // หากมีการเลือกสถานะ
        if ($status !== null) {
            $query->where('rwn_status', $status);
        }

        // ดึงข้อมูลที่ค้นพบ
        $rentals = $query->get();

        // ส่งข้อมูลไปยัง view
        return view('ManageOrders', compact('rentals'));
    }


  
    public function Update_Orders(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งมา
        $request->validate([
            'id' => 'required|integer|exists:rentals,id',
            'update_status' => 'required|boolean',
        ]);

        // ดึงข้อมูล Rental ตาม id
        $rental = Rental::find($request->id);

        // ตรวจสอบว่าพบข้อมูลหรือไม่
        if (!$rental) {
            // ถ้าไม่พบข้อมูล ให้ redirect กลับพร้อมแสดงข้อความแจ้งเตือน
            return redirect()->route('ManageOrders.Home_ManageOrders')->with('error', 'ไม่พบข้อมูลคำสั่งเช่าที่ต้องการอัปเดต');
        }
        
        // ถ้า cb ถูกติ๊ก
        if ($request->update_status) {
            $rental_day = Rental::where('id', $request->id)->value('rental_day');
            // กำหนดวันที่เริ่ม
            $start_date = now()->format('Y-m-d');

            // กำหนดวันส่งคืนโดยใช้จำนวนวันที่เช่าที่ระบุ
            $return_date = now()->addDays($rental_day)->format('Y-m-d');

            // อัปเดตข้อมูลในฐานข้อมูล
            $rental->date_keep = $start_date;
            $rental->date_expire = $return_date;

            // อัปเดตค่า rwn_status เป็น 0
            $rental->rwn_status = 0;
        } else {
            // ถ้า cb ถูกยกเลิกการติ๊ก ให้ลบวันที่ออก
            $rental->date_keep = null;
            $rental->date_expire = null;

            // อัปเดตค่า rwn_status เป็น 1
            $rental->rwn_status = 1;
        }

        // บันทึกการเปลี่ยนแปลง
        $rental->save();

        // Redirect กลับไปยังหน้าก่อนหน้า
        return redirect()->route('ManageOrders.Home_ManageOrders')->with('success', 'อัปเดตข้อมูลสำเร็จ');
    }
}
