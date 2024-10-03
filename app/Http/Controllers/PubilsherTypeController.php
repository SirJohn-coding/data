<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Manga;
use App\Models\Type_manga;
use App\Models\Pubilsher;
use App\Models\Volume;
use App\Models\User_manga;
use App\Models\Rental_detail;

class PubilsherTypeController extends Controller
{
    public function Home_Pubilsher_Type()
    {
        return view('pubilsher_type');
    }



    public function storetype(Request $request)
    {
        $request->validate([
            'tpye_name' => 'required|string|max:255',
        ]);

        $newType = new Type_manga();
        $newType->tpye_name = $request->input('tpye_name');
        $newType->save();

        return redirect()->route('adders.Home_Pubilsher_Type')->with('success', 'เพิ่มประเภทมังงะสำเร็จ!');
    }



    public function storePublisher(Request $request)
    {
        $request->validate([
            'publisher_name' => 'required|string|max:255',
        ]);

        $newPub = new Pubilsher();
        $newPub->publisher_name = $request->input('publisher_name');
        $newPub->save();

        return redirect()->route('adders.Home_Pubilsher_Type')->with('success', 'เพิ่มสำนักพิมพ์สำเร็จ!');
    }
}
