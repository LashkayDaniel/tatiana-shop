<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vishivanki extends Model
{
    use HasFactory;

    public function vishivankiTag()
    {
        return $this->belongsTo(VishivankiTags::class);
    }
}
