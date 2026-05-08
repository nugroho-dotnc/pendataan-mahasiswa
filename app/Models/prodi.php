<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Prodi extends Model
{
    protected $fillable = ['name', 'jurusan_id', 'is_active'];

    public function Jurusan():BelongsTo {
        return $this->belongsTo(Jurusan::class);
    }
    public function Mahasiswa(): HasMany{
        return $this->hasMany(User::class);
    }
}
