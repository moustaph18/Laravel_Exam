<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class location extends Model
{
    use HasFactory;

    // public function location(){
    //     return $this->belongsTo(::class);
    // }

    protected $table = 'location';
}
