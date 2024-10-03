<?php



namespace App\Http\Controllers;
use Illuminate\Support\Facades\Log;

use App\Models\Manga;
use Illuminate\Http\Request;

class VolumesController extends Controller
{
    public function show($id)
{
    Log::info('Requested manga ID: ' . $id); // บันทึก ID ที่ได้รับ
    $manga = Manga::with('volumes')->find($id); // ดึงข้อมูลมังงะตาม ID

    if (!$manga) {
        Log::warning('Manga not found: ' . $id);
        return redirect()->route('mangas.index')->with('error', 'ไม่พบข้อมูลมังงะ');
    }

    Log::info('Manga found: ', $manga->toArray());
    return view('volumes', compact('manga'));
    
}

    
    
}



