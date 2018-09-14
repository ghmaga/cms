<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
	protected $fillable = [
        'title', 'en_title', 'parent_id', 'image', 'en_image', 'link', 'order'
    ];
}
