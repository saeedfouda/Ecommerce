<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Manufacturers extends Model
{
    protected $table    = 'manufacturers';
    protected $fillable = [
            'name_ar',
            'name_en',
            'mobile'   ,
            'email' ,
            'facebook',
            'website',
            'twitter',
            'address',
            'contact_name',
            'lat',
            'lng',
            'icon' ,

    ];
}
