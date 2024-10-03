<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManageController extends Controller
{
    //
    function Home_Manage()
    {
        return view("manage");
    }



    public function search(Request $request)
    {
        if ($request->has('blacklist')) {
            // ถ้ามี blacklist ให้เรียกฟังก์ชัน searchByBlacklist
            return $this->searchByBlacklist();
        }

        // ถ้าไม่มี blacklist ให้เรียกฟังก์ชัน searchByValue พร้อมส่ง $request
        return $this->searchByValue($request);
    }

    // ฟังก์ชันค้นหาผู้ใช้ที่มี Blacklist_count >= 2
    public function searchByBlacklist()
    {
        // ค้นหาผู้ใช้ที่มี Blacklist_count >= 2 และ status เป็น 1
        $users = User::where('Blacklist_count', '>=', 2)
            ->where('status', 1)
            ->paginate(5);

        return view('manage', ['users' => $users]);
    }

    // ฟังก์ชันค้นหาผู้ใช้ตามค่าที่รับจากฟอร์ม
    public function searchByValue(Request $request)
    {
        // รับค่าจาก input ที่ส่งมาจากฟอร์ม
        $searchValue = $request->input('search');

        if (is_numeric($searchValue)) {
            // ค้นหาผู้ใช้ตาม ID หรือ Phone
            $users = User::where(function ($query) use ($searchValue) {
                $query->where('id', $searchValue)
                    ->orWhere('Phone', $searchValue);
            })
                ->where('role', 0)
                ->paginate(5);
        } else {
            // หาก searchValue ไม่ใช่ตัวเลข อาจค้นหาโดยใช้เงื่อนไขอื่น เช่น ชื่อ
            $users = User::where('name', 'like', '%' . $searchValue . '%')
                ->paginate(5);
        }

        // ตรวจสอบว่าพบข้อมูลหรือไม่
        if ($users->isEmpty()) {
            return view('manage', ['message' => 'ไม่พบข้อมูล']);
        } else {
            return view('manage', ['users' => $users]);
        }
    }


    public function show($id)
    {
        // ค้นหาข้อมูลผู้ใช้ตาม ID
        $user = User::find($id);

        if ($user) {
            // ส่งข้อมูลไปที่ view manageusr.blade.php
            return view('manageusr', compact('user'));
        } else {
            return redirect()->back()->with('error', 'ไม่พบข้อมูลผู้ใช้');
        }
    }
}
