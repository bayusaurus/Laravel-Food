<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusMeja extends Model
{
    use HasFactory;
    protected $guarded = [];

    protected $table = 'status_meja';

    public function meja()
    {
        return $this->hasMany(Meja::class);
    }
}
