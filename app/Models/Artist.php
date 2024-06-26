<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Artist extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'artists';

    protected $guarded = false;

    public function songs() {
        return $this->hasMany(Song::class);
    }
}
