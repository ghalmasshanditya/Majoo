<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orders extends Model
{
    protected $table = 'orders';
    protected $primaryKey = 'id_order';

    public function getData()
    {
        return DB::table($this->table)->Join('produks', 'produks.id_produk', '=', 'orders.id_produk')->get();
    }
}
