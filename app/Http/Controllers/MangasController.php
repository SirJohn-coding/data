<?php

namespace App\Http\Controllers;

use App\Models\Manga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log; // เพิ่มบรรทัดนี้

class MangasController extends Controller
{
    public function index()
{
    $mangas = Manga::all(); // ดึงข้อมูลมังงะทั้งหมด
    Log::info('Mangas fetched: ', $mangas->toArray()); // บันทึกข้อมูลที่ดึงมา
    return view('mangas', compact('mangas')); // ส่งข้อมูลไปยัง View
}
}

