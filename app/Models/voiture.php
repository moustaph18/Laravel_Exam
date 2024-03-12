<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class voiture extends Model
{
    use HasFactory;
    protected $table = 'voiture';
    public function voiture(){
        return $this->belongsToMany(permis::class);
    }
}
