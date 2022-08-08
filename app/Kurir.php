<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Kurir extends Model
{
    //
    use SoftDeletes;
    protected $table = 'kurir';
    protected $primaryKey = 'idkurir';
    protected $dates = ['deleted_at'];
}
