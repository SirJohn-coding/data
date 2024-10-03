<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\User;
use App\Models\Type_manga;
use App\Models\Pubilsher;
use App\Models\Volume;
use App\Models\User_manga;
use App\Models\Rental_detail;
use App\Models\Rental;
use Illuminate\Support\Facades\Auth;

class BasketController extends Controller
{
    public function ShowBasket()
    {
        $id = auth()->id(); // กำหนดค่า id ของผู้ใช้
        $details = collect();  // กำหนดค่าเริ่มต้น
        $detailsVolume = collect(); // กำหนดค่าเริ่มต้นให้เป็นคอลเลกชันว่าง

        if (is_numeric($id)) {
            // ดึงข้อมูลจากตาราง Rental ที่มี status เป็น 0 สำหรับผู้ใช้ปัจจุบัน
            $rental = Rental::where('Id_user_manga', $id)
                ->where('status', 0)
                ->first();

            if ($rental) {
                // ดึงข้อมูลจากตาราง Rental_detail โดยเช็ค id_rental ที่ตรงกับ rental ที่ได้มา
                $details = Rental_detail::where('id_rental', $rental->id)
                    ->where('id_user_manga', $id)
                    ->get();

                // ดึง id_volume ของมังงะที่เลือก
                $volumeIds = $details->pluck('id_volume')->toArray();

                // เช็คว่ามังงะเล่มนั้นๆ ยังเหลืออยู่หรือไม่ (Amount > 0)
                $detailsVolume = Volume::whereIn('id', $volumeIds)
                    ->where('Amount', '>', 0)
                    ->get();
            }
        }

        // ส่งข้อมูลไปยัง view
        return view('basket', compact('details', 'detailsVolume'));
    }




    public function Checkout(Request $request)
    {
        // รับข้อมูลที่ส่งมาจากฟอร์ม
        $selectedItems = $request->input('selected_items');

        $id = auth()->id(); //ทดสอบเป็น ID ของผู้ใช้
        $user = User::find($id);

        // ตรวจสอบว่ามีรายการที่เลือกหรือไม่
        if (!$selectedItems) {
            return redirect()->back()->with('error', 'กรุณาเลือกรายการมังงะที่ต้องการเช่า');
        }

        // ดึงข้อมูลของ Volume ตามรายการที่เลือกจากฐานข้อมูล
        $volumes = Volume::whereIn('id', $selectedItems)->get();

        // คำนวณยอดรวม
        $total = $volumes->sum('Price_Rental');
        $order = Rental::where('status', 0)
            ->where('id_user_manga', Auth::user()->id)
            ->first();
        // ตัวอย่าง: ส่งข้อมูลไปยังหน้าสรุปการเช่าหรือดำเนินการต่อ
        return view('SummaryRental', [
            'volumes' => $volumes,
            'total' => $total,
            'user' => $user,
            'order' => $order
        ]);
    }

    public function DeleteVolumes($id)
    {
        // ค้นหารายการที่ต้องการลบ
        $details = Rental_detail::where('id_volume', $id);

        // ตรวจสอบว่ามีข้อมูลหรือไม่
        if ($details) {
            // ลบข้อมูล
            $details->delete();

            // เปลี่ยนเส้นทางไปที่ ShowBasket
            return redirect()->route('Basketmanga.ShowBasket')
                ->with('success', 'ลบสินค้าเรียบร้อยแล้ว');
        }

        // กรณีไม่พบข้อมูลที่ต้องการลบ
        return redirect()->route('Basketmanga.ShowBasket')
            ->with('error', 'ไม่พบข้อมูลที่จะลบ');
    }
}
