<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StatusTransaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'status_transaksi';

    public function transaksi()
    {
        return $this->hasMany(Transaksi::class);
    }
}
