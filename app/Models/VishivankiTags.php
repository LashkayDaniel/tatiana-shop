<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VishivankiTags extends Model
{
    use HasFactory;

    public function vishivanki()
    {
        return $this->hasMany(Vishivanki::class, 'vishivanki_tag_id');
    }

}
