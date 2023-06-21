<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    /* Asignación masiva para poder usar nuestro modelo. */
    protected $fillable = ['title', 'content', 'image'];
}
