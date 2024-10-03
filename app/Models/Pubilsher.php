<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Pubilsher extends Model
{
    use HasFactory;
    use softDeletes;

    protected $table = 'pubilshers';
    protected $fillable = ['publisher_name'];


    public function pmangas(){
        return $this->hasMany(Manga::class, 'id');
    }
}
