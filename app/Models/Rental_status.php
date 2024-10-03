<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Rental_status extends Model
{
    use HasFactory;
    use softDeletes;



    public function rentals(){
        return $this->hasMany(Rental::class, 'id');
    }
}
