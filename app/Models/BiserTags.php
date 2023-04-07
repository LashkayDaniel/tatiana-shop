<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BiserTags extends Model
{
    use HasFactory;

    public function biser()
    {
        return $this->hasMany(Biser::class, 'biser_tag_id');
    }
}
