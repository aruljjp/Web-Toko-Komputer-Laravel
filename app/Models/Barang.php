<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;
    protected $table='tb_barang';
    protected $fillable=['nama','diskon','id_kategori','harga','stok','keterangan','foto'];
}