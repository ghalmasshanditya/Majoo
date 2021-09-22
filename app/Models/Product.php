<?php

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    // use HasFactory;
    protected $table = 'produks';
    protected $primaryKey = 'id_produk';

    public function getData()
    {
        return DB::table($this->table)->get();
    }

    public function editData($data, $id)
    {
        $result = DB::table($this->table)
            ->where($this->primaryKey, $id)
            ->update($data);
        return $result;
    }

    public function getDataById($id)
    {
        $data = DB::table($this->table)->where($this->primaryKey, $id)->first();
        return $data;
    }

    public function deleteData($id)
    {
        $result = DB::table($this->table)
            ->where($this->primaryKey, $id)
            ->delete();
        return $result;
    }

    public function updateData($data, $id)
    {
        return DB::table($this->table)
            ->where($this->primaryKey, $id)
            ->update($data);
    }
}
