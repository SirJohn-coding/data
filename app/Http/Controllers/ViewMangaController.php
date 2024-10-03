<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Manga;
use App\Models\Volume;

class ViewMangaController extends Controller
{
    function Home_ViewManga()
    {
        
        return view("viewmanga");
    }




    public function show($id)
    {
        $mangaResults = Manga::find($id);

        if ($mangaResults) {
            $VolumeResults = Volume::where('Id_Manga', $id)->paginate(3);

            return view('viewmanga', compact('mangaResults', 'VolumeResults'));
        } else {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลมังงะ');
        }
    }




    public function Addshow($id)
    {
        $mangaResults = Manga::find($id);

        if ($mangaResults) {
            return view('addmanga', compact('mangaResults'));
        } else {
            return redirect()->back()->with('error', 'ไม่สามารถเพิ่มข้อมูลมังงะได้');
        }
    }




    public function SearchManga(Request $request, $id)
    {
        $searchValue = trim($request->input('SearchManga'));

        $VolumeResults = Volume::where('No_volume', $searchValue)
            ->where('Id_Manga', $id)
            ->paginate(3);

        $mangaResults = Manga::find($id);

        if ($VolumeResults->isEmpty()) {
            return view('viewmanga', [
                'mangaResults' => $mangaResults,
                'message' => 'ไม่พบข้อมูลเล่มที่ค้นหา'
            ]);
        } else {
            return view('viewmanga', [
                'mangaResults' => $mangaResults,
                'VolumeResults' => $VolumeResults
            ]);
        }
    }
}
