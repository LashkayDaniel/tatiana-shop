<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biser extends Model
{
    use HasFactory;

    public function biserTag()
    {
        return $this->belongsTo(BiserTags::class);
    }
}
