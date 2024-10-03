<?php

namespace App\Http\Controllers;
use App\Models\Manga;
use Illuminate\Http\Request;

class AllmangaController extends Controller
{
    public function AllmangaPage()
    {
        $Mangas = Manga::all(); // ดึงข้อมูลทั้งหมดจากตาราง mangas
    return view('Allmanga', compact('Mangas')); // ส่งข้อมูลไปยังวิว
    }
    //
}
