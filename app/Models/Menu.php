<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $guarded = [];
    protected $table = "menu";

    public function jenisMenu()
    {
        return $this->belongsTo(JenisMenu::class, 'jenis_menu_id');
    }

    public function transaksi()
    {
        return $this->belongsToMany(Transaksi::class);
    }
}
