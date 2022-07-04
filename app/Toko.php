<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Toko extends Model
{
    public $timestamps = false;
    protected $table = 'toko';
    protected $primaryKey = 'users_id';
    // protected $fillable =   [
    //                             'email',
    //                             'verification_token'
    //                         ];
    

}
