<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchemeTags extends Model
{
    use HasFactory;

    public function scheme()
    {
        return $this->hasMany(Scheme::class, 'scheme_tag_id');
    }
}
