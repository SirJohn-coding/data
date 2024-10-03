<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rental;
use App\Models\Volume;
use App\Models\Rental_detail;
use App\Models\User;

class OrderDetailsController extends Controller
{
    public function Home_OrderDetails($id)
    {
        $DetailResult = Rental_detail::where('id_rental', $id)->paginate(5);
        $UserResult = Rental_detail::where('id_rental', $id)->first();
        return view('OrderDetails', ['DetailResult' => $DetailResult, 'UserResult' => $UserResult]);
    }




    public function CancelOrder($id)
    {
        // ดึงข้อมูลรายละเอียดการเช่า
        $DetailResult = Rental_detail::where('id_rental', $id)->get();

        // ตรวจสอบว่ามีรายละเอียดการเช่าหรือไม่
        if ($DetailResult->isEmpty()) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลคำสั่งเช่า');
        }

        // ดึงข้อมูลการเช่าที่สัมพันธ์
        //$RentalResult = Rental::where('id', $id)->first(); // ใช้ first แทน get เพราะต้องการเพียง 1 รายการ

        // ลูปผ่านรายละเอียดการเช่าเพื่ออัปเดต Amount
        foreach ($DetailResult as $Detail) {
            $VolumesResult = Volume::where('id', $Detail->id_volume)->first(); // ใช้ first แทน get

            if ($VolumesResult) {
                $VolumesResult->Amount = 1; // อัปเดตค่า Amount
                $VolumesResult->save(); // บันทึกการเปลี่ยนแปลง
            }
        }

        // อัปเดต Blacklist_count ในตาราง User แค่ครั้งเดียว
        $firstDetail = $DetailResult->first(); // ดึงรายละเอียดการเช่ารายการแรก
        if ($firstDetail) {
            $userId = $firstDetail->id_user_manga; // ดึงค่า id_user_manga จากรายการแรก
            $user = User::where('id', $userId)->first(); // ดึงข้อมูลผู้ใช้จากตาราง User

            if ($user) {
                $user->Blacklist_count += 1; // เพิ่มค่า Blacklist_count
                $user->save(); // บันทึกการเปลี่ยนแปลง
            }
        }

        // ลบข้อมูลใน Rental_detail โดยใช้ id_rental
        Rental_detail::where('id_rental', $id)->delete();

        // ลบข้อมูลใน Rental
        Rental::where('id', $id)->delete();

        // ส่งข้อความยืนยันการยกเลิกคำสั่งเช่า
        return redirect()->route('ManageOrders.Home_ManageOrders')->with('success', 'ยกเลิกคำสั่งเช่าเรียบร้อยแล้ว');
    }
}
