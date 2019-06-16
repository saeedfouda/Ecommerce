<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table    = 'countries';
    protected $fillable = [
        'Country_name_ar',
        'Country_name_en',
        'mob',
        'code',
        'logo',
    ];
}
