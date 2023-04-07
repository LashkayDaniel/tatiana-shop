<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Clothes extends Model
{
    use HasFactory;

    public function clothesTag()
    {
        return $this->belongsTo(ClothesTags::class);
    }
}
