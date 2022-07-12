<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class GambarProduk extends Model
{
    //
    // use SoftDeletes;
    protected $table = 'gambar_produk';
    protected $primaryKey = 'idgambar_produk';
    protected $dates = ['deleted_at'];
    public $incrementing = false;
    // In Laravel 6.0+ make sure to also set $keyType
    protected $keyType = 'string';
}
