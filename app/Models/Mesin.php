<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mesin extends Model
{
    use HasFactory;
    protected $table = "mesin_minings";
    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class,'users_id');
    }
}
