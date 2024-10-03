<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Manga;
use App\Models\Type_manga;
use App\Models\Pubilsher;

use App\Models\Volume;

class UpdateMangaController extends Controller
{


    public function ShowManga($id)
    {
        $mangaResults = Manga::with('type', 'pubilsher')->find($id);
        $mangaTypes = Type_manga::all(); // ดึงประเภทมังงะทั้งหมด
        $pubilsher = pubilsher::all(); // ดึงสำนักพิมพ์ทั้งหมด

        if ($mangaResults) {
            return view('updatemanga', compact('mangaResults', 'mangaTypes', 'pubilsher'));
        } else {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลมังงะ');
        }
    }




    function EditManga(Request $request, $id)
    {

        // ตรวจสอบว่ามีการอัปโหลดไฟล์ภาพหรือไม่
        if ($request->hasFile('mangaImage')) {
            $file = $request->file('mangaImage');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/Manga/'), $filename); // บันทึกไฟล์ที่โฟลเดอร์ public/images
            $fullImagePath = 'images/Manga/' . $filename;
        } else {
            $fullImagePath = 'images/Manga/default.jpg'; // ไฟล์พื้นฐานกรณีไม่มีการอัปโหลดรูปภาพ
        }

        $EditManga = Manga::find($id);
        
        $EditManga->image = $fullImagePath;

        if ($request->filled('manganame')) {
            $EditManga->manga_title = $request->input('manganame');
        }

        if ($request->filled('summaryManga')) {
            $EditManga->manga_story = $request->input('summaryManga');
        }

        if ($request->filled('manga_type')) {
            $EditManga->Id_type = $request->input('manga_type');
        }

        if ($request->filled('publisher')) {
            $EditManga->Id_pubilsher = $request->input('publisher');
        }

        $EditManga->save();

        return redirect()->route('viewmanga.show', ['id' => $id])->with('success', 'อัปเดตข้อมูลมังงะเรียบร้อยแล้ว');
    }




    public function DeleteManga($id)
    {
        // ค้นหา Manga ที่ต้องการลบ
        $mangaResults = Manga::find(id: $id);

        if ($mangaResults) {
            // ค้นหาและลบ Volumes ที่เกี่ยวข้องกับ Manga นี้
            $VolumeResults = Volume::where('id_manga', $mangaResults->id)->get();

            // ลบ Volumes ทั้งหมดที่เกี่ยวข้อง
            foreach ($VolumeResults as $volume) {
                $volume->delete();
            }

            // ลบข้อมูล Manga
            $mangaResults->delete();

            // ส่งกลับไปยังหน้า view พร้อมข้อความสำเร็จ
            return view('searchmanga')
                ->with('success', 'ลบข้อมูล Manga และ Volume เรียบร้อยแล้ว');
        } else {
            // ถ้าไม่พบ Manga ให้ส่งกลับพร้อมข้อความแจ้งเตือน
            return view('searchmanga')
                ->with('error', 'ไม่พบข้อมูล Manga');
        }
    }
}
