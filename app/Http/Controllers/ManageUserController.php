<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller
{
    // ฟังก์ชันสำหรับการลบบัญชีผู้ใช้
    public function delete($id)
    {
        $deleteid = User::find($id);
        
        if ($deleteid) {
            $deleteid->delete(); 
            return redirect('/manage')->with('success', 'ลบบัญชีผู้ใช้ สำเร็จ');
        }
        return redirect('/manage')->with('error', 'ไม่พบบัญชีผู้ใช้');
    }





    // ฟังก์ชันสำหรับการแบนบัญชีผู้ใช้
    public function ban($id)
    {
        // ค้นหาข้อมูลที่มีอยู่ด้วย ID
        $user = User::find(id: $id);

        // ตรวจสอบว่าข้อมูลนั้นมีอยู่หรือไม่
        if (!$user) {
            return redirect()->route('manage.show', ['id' => $id])->with('error', 'ไม่พบข้อมูลที่ต้องการ');
        }

        // อัพเดตค่าใน status
        if ($user->status == 1) {
            // ถ้า status เป็น 1 ให้เปลี่ยนเป็น 0
            $user->status = 0;
        } else {
            // ถ้า status เป็น 0 ให้เปลี่ยนเป็น 0
            $user->status = 0;
            return redirect()->route('manage.show', ['id' => $id])->with('warning', 'บัญชีผู้ใช้ถูกแบนอยู่แล้ว');
        }

        $user->save();

        return redirect()->route('manage.show', ['id' => $id])->with('success', 'แบนบัญชีผู้ใช้ สำเร็จ');
    }




    // ฟังก์ชันสำหรับการปลดแบนบัญชีผู้ใช้
    public function unban($id)
    {
        // ค้นหาข้อมูลที่มีอยู่ด้วย ID
        $user = User::find($id);

        // ตรวจสอบว่าข้อมูลนั้นมีอยู่หรือไม่
        if (!$user) {
            return redirect("/manage/{$id}")->with('error', 'ไม่พบข้อมูลที่ต้องการ');
        }

        // อัพเดตค่าใน status
        if ($user->status == 0) {// ถ้า status เป็น 0 ให้เปลี่ยนเป็น 1
            $user->status = 1;
            $user->Blacklist_count = 0;
        }else{
            return redirect("/manage/{$id}")->with('warning', 'บัญชีผู้ใช้ไม่ได้ถูกแบน');
        }

        $user->save();

        return redirect("/manage/{$id}")->with('success', 'ปลดแบนบัญชีผู้ใช้ สำเร็จ');
    }
}
