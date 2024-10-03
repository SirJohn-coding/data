<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Rental extends Model
{
    use HasFactory;
    use softDeletes;


    protected $table = 'rentals';
    protected $fillable = [
        'status',
        'date_rent',
        'date_keep',
        'date_expire',
        'return_status',
        'not_return_status',
        'waiting_status',
        'Id_user_manga',
    ];

    public function volumes(){
        return $this->belongsToMany(Volume::class, 'rental_details','id_volume');
    }



    public function User(){
        return $this->belongsTo(User::class, 'Id_user_manga');
    }

    public function Rental_status(){
        return $this->belongsTo(Rental_status::class, 'Id_status');
    }

}
