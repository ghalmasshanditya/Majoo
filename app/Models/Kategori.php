<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Kategori extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';

    public function getData()
    {
        return DB::table($this->table)->get();
    }

    public function updateData($data, $id)
    {
        $result = DB::table($this->table)
            ->where($this->primaryKey, $id)
            ->update($data);
        return $result;
    }

    public function deleteData($id)
    {
        $result = DB::table($this->table)
            ->where($this->primaryKey, $id)
            ->delete();
        return $result;
    }
}
