<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'transaksi';

    public function statusTransaksi()
    {
        return $this->belongsTo(StatusTransaksi::class, 'status_transaksi_id');
    }
    public function meja()
    {
        return $this->belongsTo(Meja::class, 'meja_id');
    }
    public function menu()
    {
        return $this->belongsToMany(Menu::class)->withPivot([
            'user_id',
            'harga',
            'kuantitas',
            'subtotal'
        ]);
    }
}
