<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class contrat extends Model
{
    use HasFactory;
    protected $table = 'contrat';
    public function contrat(){
        return $this->belongsTo(permis::class);
    }
}
