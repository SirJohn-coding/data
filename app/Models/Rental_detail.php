<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental_detail extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'rental_details'; // ชื่อของตารางที่ถูกต้อง

    public function rental() {
        return $this->belongsTo(Rental::class, 'id_rental');
    }

    public function volume() {
        return $this->belongsTo(Volume::class, 'id_volume');
    }

    public function user() {
        return $this->belongsTo(User::class, 'id_user_manga');
    }

    public function manga() {
        return $this->belongsTo(Manga::class, 'id_Manga');
    }
}
