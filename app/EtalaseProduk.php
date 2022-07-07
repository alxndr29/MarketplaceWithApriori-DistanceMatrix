<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class EtalaseProduk extends Model
{
    //
    use SoftDeletes;
    protected $table = 'etalase_produk';
    protected $primaryKey = 'idetalase_produk';
    protected $dates = ['deleted_at'];
}
