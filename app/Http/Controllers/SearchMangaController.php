<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Type_manga;
use App\Models\pubilshers;

class SearchMangaController extends Controller
{
    //
    function Home_SearchManga()
    {
        return view("searchmanga");
    }




    
    function SearchManga(Request $request)
    {
        $searchValue = $request->input('SearchManga');

        if (is_numeric($searchValue)) {
            $mangaResults = Manga::where('id', $searchValue)->paginate(4);
        } else {
            $mangaResults = Manga::where('manga_title', 'LIKE', "%{$searchValue}%")->paginate(4);
        }

        $mangaResults->appends(['SearchManga' => $searchValue]);

        if ($mangaResults->isEmpty()) {
            return view('searchmanga', ['message' => 'ไม่พบข้อมูล']);
        } else {
            return view('searchmanga', ['mangaResults' => $mangaResults]);
        }
    }
}
