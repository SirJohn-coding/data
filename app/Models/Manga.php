<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\softDeletes;

class Manga extends Model
{
    use HasFactory;
    use softDeletes;



    protected $table = 'mangas';

    protected $fillable = ['manga_title','manga_story'];

    public function pubilsher(){
        return $this->belongsTo(pubilsher::class, 'Id_pubilsher');
    }

    public function type(){
        return $this->belongsTo(Type_manga::class, 'Id_type');
    }

    public function volumes(){
        return $this->hasMany(Volume::class, 'Id_Manga');
    }

}
