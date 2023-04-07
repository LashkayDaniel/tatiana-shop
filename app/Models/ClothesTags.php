<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClothesTags extends Model
{
    use HasFactory;

    public function clothes()
    {
        return $this->hasMany(Clothes::class, 'clothes_tag_id');
    }
}
