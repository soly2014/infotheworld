<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UploadImage extends Model
{
    protected $table = 'uploaded_images';
    public $timestamps = false;
}
