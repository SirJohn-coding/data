<?php

namespace App\Http\Controllers;
use App\Models\Manga;
use App\Models\Volume; 
use Illuminate\Http\Request;

class MangaController extends Controller
{
    //
    public function HomePage()
    {
        $Manganew = Manga::orderBy('updated_at', 'desc')->get();
        return view("HomePage",compact('Manganew'));
    }

    public function Search(Request $request)
{
    $query = $request->input('search'); // รับค่าค้นหาจากฟอร์ม

    // ถ้ามีการค้นหาให้ค้นหาตามชื่อเรื่อง manga_title
    if ($query) {
    $Mangas = Manga::when($query, function($queryBuilder) use ($query) {
        return $queryBuilder->where('manga_title', 'like', '%' . $query . '%');
    })->get();
}
else {
    $Mangas = collect(); // ถ้าไม่มีการค้นหาให้ใช้ Collection ว่าง
}
    return view('Search', compact('Mangas'));
}
}
