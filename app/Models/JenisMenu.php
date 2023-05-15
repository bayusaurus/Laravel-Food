<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JenisMenu extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'jenis_menu';
    
    public function menu()
    {
        return $this->hasMany(Menu::class);
    }
}
