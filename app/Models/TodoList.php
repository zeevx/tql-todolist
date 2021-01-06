<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class TodoList extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'body', 'done'];

}
