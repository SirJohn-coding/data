<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Type_manga extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'type_mangas';  // ชื่อตารางต้องตรงกับในฐานข้อมูล
    protected $fillable = ['tpye_name']; // ฟิลด์ที่สามารถกรอกข้อมูลได้


    public function mangas(){
        return $this->hasMany(Manga::class, 'id');
    }

}
