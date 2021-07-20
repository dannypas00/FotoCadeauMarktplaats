<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Advert extends \App\Models\Model
{
    use HasFactory;

    public $heading;
    public $body;
    public $poster;

    protected $fillable = [
        'heading',
        'body',
        'poster'
    ];
}
