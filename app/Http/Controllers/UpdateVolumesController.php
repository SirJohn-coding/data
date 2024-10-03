<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Type_manga;
use App\Models\Pubilsher;
use App\Models\Volume;

class UpdateVolumesController extends Controller
{
    public function ShowVolumes($id)
    {
        $volume = Volume::with('manga.type', 'manga.pubilsher')->find($id);

        if ($volume) {
            $mangaTypes = Type_manga::all(); // ดึงประเภทมังงะทั้งหมด
            $publishers = Pubilsher::all(); // ดึงสำนักพิมพ์ทั้งหมด

            return view('updatevolumes', [
                'volume' => $volume,
                'mangaTypes' => $mangaTypes,
                'publishers' => $publishers,
            ]);
        } else {
            return redirect()->back()->with('error', 'ไม่พบข้อมูล Volume');
        }
    }


    public function EditVolumes(Request $request, $id)
    {

        // ตรวจสอบว่ามีการอัปโหลดไฟล์ภาพหรือไม่
        if ($request->hasFile('mangaImage')) {
            $file = $request->file('mangaImage');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/Volume/'), $filename); // บันทึกไฟล์ที่โฟลเดอร์ public/images
            $fullImagePath = 'images/Volume/' . $filename;
        }

        // ค้นหา Volume ที่ต้องการแก้ไข
        $editVolume = Volume::find($id);
        if($request->hasFile('mangaImage')){
            $editVolume->image_volume = $fullImagePath;
        }
        
        // ค้นหามังงะตาม ID ที่ถูกต้อง
        if ($editVolume) {
            $mangaResults = Manga::find($editVolume->Id_Manga);
            // รับราคาและคำนวณราคาเช่าจาก request
            $price = $request->input('priceManga');
            if ($price) {
                $priceRental = $price * 0.10;
                $editVolume->Price = $price;
                $editVolume->Price_Rental = $priceRental;
            }

            $editVolume -> No_volume = $request->input('VolumeManga');

            // อัปเดตข้อมูล Volume
            $editVolume->save();

            return redirect()->route('viewmanga.show', ['id' => $mangaResults->id])->with('success', 'อัปเดตข้อมูล Volume เรียบร้อยแล้ว');
        } else {
            return redirect()->back()->with('error', 'ไม่พบข้อมูล Volume.');
        }
    }


    public function DeleteVolumes($id)
    {
        $VolumeResults = Volume::find($id);

        if ($VolumeResults) {
            $mangaResults = Manga::find($VolumeResults->Id_Manga);

            $VolumeResults->delete();

            if ($mangaResults) {
                $VolumeResults = Volume::where('Id_Manga', $mangaResults->id)->get();

                return view('viewmanga', compact('mangaResults', 'VolumeResults'));
            }
        }

        return redirect()->back()->with('error', 'ไม่พบข้อมูล Volume');
    }


    public function UpdateVolumes($id)
    {
        // ค้นหาข้อมูลที่มีอยู่ด้วย ID
        $VolumeResults = Volume::find($id);


        // อัพเดตค่าใน status
        if ($VolumeResults->Amount == 0) {// ถ้า status เป็น 0 ให้เปลี่ยนเป็น 1
            $VolumeResults->Amount = 1;
        }else{
            return redirect()->route('updatevolumes.ShowVolumes', ['id' => $id])->with('warning', 'ไม่สามารถอัปเดตได้');
        }

        $VolumeResults->save();

        return redirect()->route('updatevolumes.ShowVolumes', ['id' => $id])->with('success', 'อัปเดตมังงะ สำเร็จ');
    }
}
