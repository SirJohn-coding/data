<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Volume;

class AddMangaController extends Controller
{
    //
    function home()
    {
        return view("addmanga");
    }


    public function AddManga(Request $request)
    {
        // ตรวจสอบว่ามีการอัปโหลดไฟล์ภาพหรือไม่
        if ($request->hasFile('mangaImage')) {
            $file = $request->file('mangaImage');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/Volume/'), $filename); // บันทึกไฟล์ที่โฟลเดอร์ public/images
            $fullImagePath = 'images/Volume/' . $filename;
        } else {
            $fullImagePath = 'images/Volume/default.jpg'; // ไฟล์พื้นฐานกรณีไม่มีการอัปโหลดรูปภาพ
        }


        $AddManga = new Volume();
        $AddManga->Id_Manga = $request->input('idmanga');
        $AddManga->Id_location = 1;

        $AddManga->volume_name = $request->input('manganame');
        $AddManga->No_volume = $request->input('VolumeManga');

        $AddManga->image_volume = $fullImagePath;

        $price = $request->input('priceManga');

        // คำนวณราคาค่าเช่าที่เป็น 10% ของราคาปก
        $priceRental = $price * 0.10;

        $AddManga->Price = $price;
        $AddManga->Price_Rental = $priceRental;

        $AddManga->Amount = 1;

        $AddManga->save();


        return redirect()->route('viewmanga.show', ['id' => $AddManga->Id_Manga])->with('success', 'เพิ่มมังงะใหม่เรียบร้อยแล้ว!');
    }
}
