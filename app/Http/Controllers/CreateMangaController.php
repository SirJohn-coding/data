<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;
use App\Models\Type_manga;
use App\Models\Pubilsher;
use App\Models\Manga;

class CreateMangaController extends Controller
{
    //
    function Home_CreateManga()
    {
        $mangaTypes = Type_manga::all();
        $pubilsher = Pubilsher::all();
        return view('createmanga', compact('mangaTypes', 'pubilsher'));
    }



    public function CreateManga(Request $request)
    {
        // ตรวจสอบข้อมูลที่ส่งเข้ามา
        $request->validate([
            'manganame' => 'required|string|max:45',
            'manga_type' => 'required',
            'publisher' => 'required',
            'summaryManga' => 'required|string|max:1000',
        ]);

        // ตรวจสอบว่ามีการอัปโหลดไฟล์ภาพหรือไม่
        if ($request->hasFile('mangaImage')) {
            $file = $request->file('mangaImage');
            $filename = $file->getClientOriginalName();
            $file->move(public_path('images/Manga/'), $filename); // บันทึกไฟล์ที่โฟลเดอร์ public/images
            $fullImagePath = 'images/Manga/' . $filename;
        } else {
            $fullImagePath = 'images/Manga/default.jpg'; // ไฟล์พื้นฐานกรณีไม่มีการอัปโหลดรูปภาพ
        }

        // บันทึกข้อมูลลงในฐานข้อมูล
        $newManga = new Manga();
        $newManga->manga_title = $request->input('manganame');
        $newManga->manga_story = $request->input('summaryManga');
        $newManga->Id_pubilsher = $request->input('publisher');
        $newManga->Id_type = $request->input('manga_type');
        $newManga->image = $fullImagePath; // บันทึกพาธของรูปภาพ

        $newManga->save(); // บันทึกข้อมูลลงในฐานข้อมูล

        return redirect('/searchmanga')->with('success', 'เพิ่มมังงะใหม่เรียบร้อยแล้ว!');
    }
}
