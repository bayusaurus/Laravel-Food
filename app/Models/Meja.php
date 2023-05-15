<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meja extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];

    protected $table = 'meja';

    public function statusMeja()
    {
        return $this->belongsTo(StatusMeja::class);
    }

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
