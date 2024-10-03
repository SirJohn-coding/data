<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use App\Models\Rental_detail;
use App\Models\Volume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RentalsController extends Controller
{
    // public function index()
    // {
    //     // ดึงข้อมูลการเช่าทั้งหมดเพื่อแสดงในหน้า
    //     $rentals = Rental::with('userManga', 'volumes')->get();

    //     // ส่งข้อมูลไปยัง view 'rentals.index'
    //     return view('rentals.index', compact('rentals'));
    // }
    public function store(Request $request)
    {
        // ตรวจสอบว่าผู้ใช้ล็อกอินอยู่
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'กรุณาล็อกอินก่อนทำการเช่า');
        }

        // ตรวจสอบข้อมูลที่ส่งเข้ามา
        $request->validate([
            'Id_volume' => 'required|exists:volumes,id',
        ]);
        $volume = Volume::find($request->Id_volume); // ดึงข้อมูล volume ที่มี Id_volume ตรงกับที่เลือก
        if (!$volume) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลเล่มที่เลือก');
        }
        // สร้างการเช่าใหม่
        // try {
        //     $rental = Rental::create([
        //         'status' => 0,
        //         'date_rent' => now(),
        //         'Id_user_manga' => Auth::user()->id,
        //         'rwn_status' => 'A',
        //     ]);
        //     $rentalId = $rental->id;
        //     // เพิ่มข้อมูลเล่มมังงะใน rental_details
        //     $rental->volumes()->attach($request->Id_volume, [
        //         // กำหนดค่าที่คุณต้องการบันทึกใน pivot table
        //         'status' => 1,
        //     ]);
        $checkstatus = Rental::where('status', 0)
                            ->where('id_user_manga', Auth::user()->id)
                            ->first();
        
        if (!$checkstatus) {
            $rental = new Rental();
        $rental->status = 0;
        $rental->id_user_manga = Auth::user()->id;
        $rental->save();
        $rentalId = $rental->id;
        Rental_detail::where('id_user_manga',Auth::user()->id)->where('status',1)->update(['id_rental' => $rental->id]);
        } else {
            // ถ้ามีการเช่าอยู่แล้ว ให้ใช้ id ของ rental ที่มีอยู่
            $rentalId = $checkstatus->id;
            Rental_detail::where('id_user_manga',Auth::user()->id)->where('status',1)->update(['id_rental' => $checkstatus->id]);
        }
    
        $volume = Volume::find($request->Id_volume);
    if (!$volume) {
        return redirect()->back()->with('error', 'ไม่พบข้อมูลเล่มที่เลือก');
    }
        $rentalDetail = new Rental_detail();
        $rentalDetail->id_rental = $rentalId;
        $rentalDetail->id_user_manga = Auth::user()->id;
        $rentalDetail->id_Manga = $volume->Id_Manga;
        $rentalDetail->id_volume = $request->Id_volume;
        $rentalDetail->rent_price = $volume->Price_Rental;
        $rentalDetail->amount_manga = $volume->Amount;
        $rentalDetail->status = 1;
        $rentalDetail->save();
            return redirect('/ShowBasket')->with('success', 'เช่าเรียบร้อยแล้ว');
        } 
    

    public function show($id)
    {
        $rental = Rental::with('volumes')->findOrFail($id);

        return view('rentals.show', compact('rental'));
    }
}


