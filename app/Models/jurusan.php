<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jurusan extends Model
{
    protected $fillable = ['name', 'is_active'];

   public function Prodi(): HasMany {
    return $this->hasMany(Prodi::class);
   }
}
