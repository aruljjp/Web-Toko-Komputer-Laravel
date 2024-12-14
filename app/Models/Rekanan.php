<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rekanan extends Model
{
    use HasFactory;
    protected $table='tb_rekanan';
    protected $fillable=['nama','alamat','telp','jkel'];
}
