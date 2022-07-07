<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Produk extends Model
{
    //
    use SoftDeletes;
    protected $table = 'produk';
    protected $primaryKey = 'idproduk';
    protected $dates = ['deleted_at'];
}
