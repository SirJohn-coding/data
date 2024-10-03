<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Type_manga;
use App\Models\Pubilsher;
use App\Models\Volume;

class UpdateController extends Controller
{

    public function Home_Upate()
    {
        return view("update");
    }


    public function SearchVolumes(Request $request)
    {
        $SearchManga = trim($request->input('SearchManga'));
        $SearchNumber = trim($request->input('SearchNumber'));


        $VolumeResults = Volume::where('volume_name', 'LIKE', "%{$SearchManga}%")
            ->where('No_volume', $SearchNumber)
            ->paginate(1);
            $VolumeResults -> appends(['SearchManga' => $SearchManga , 'SearchNumber' => $SearchNumber]);

        if ($VolumeResults->isEmpty()) {
            return view('update', [
                'VolumeResults' => $VolumeResults,
                'message' => 'ไม่พบข้อมูลเล่มที่ค้นหา'
            ]);
        } else {
            return view('update', [
                'VolumeResults' => $VolumeResults,
            ]);
        }
    }




    public function UpdateVolumes($id)
    {
        // ค้นหาข้อมูลที่มีอยู่ด้วย ID
        $VolumeResults = Volume::find($id);

        // ตรวจสอบว่าพบข้อมูลหรือไม่
        if (!$VolumeResults) {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลมังงะที่ต้องการอัปเดต');
        }

        // อัพเดตค่าใน Amount
        if ($VolumeResults->Amount == 0) { // ถ้า Amount เป็น 0 ให้เปลี่ยนเป็น 1
            $VolumeResults->Amount = 1;
        } else {
            return redirect()->back()->with('warning', 'ไม่สามารถอัปเดตได้');
        }

        $VolumeResults->save();

        return redirect()->back()->with('success', 'อัปเดตมังงะ สำเร็จ');
    }
}
