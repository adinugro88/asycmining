<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datahasil extends Model
{
    protected $table = 'datahasil';

    protected $guarded = [];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }

   
}
