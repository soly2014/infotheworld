<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country2 extends Model
{
    protected $table = 'countries';
    protected $fillable = ['sortname', 'name', 'ar_name', 'de_name', 'es_name', 'fr_name', 'hi_name', 'ja_name', 'pt_name', 'ru_name', 'tr_name', 'zh_name'];
    public $timestamps = false;
}
