<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Volume extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'volumes';

    protected $fillable = ['volume_name','No_volume' ,'Price', 'Price_Rental', 'Amount', 'Id_Manga'];

    //'image_volume', 

    public function rentals(){
        return $this->belongsToMany(Rental::class, 'rental_details','id_rental','id_volume', 'Id_Manga');
    }

    public function manga()
    {
        return $this->belongsTo(Manga::class, 'Id_Manga'); // ตรวจสอบว่าชื่อคอลัมน์ 'Id_Manga' ตรงกับที่เชื่อมโยงกับ manga
    }

}
