<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcribtion extends Model
{
    protected $fillable = ['name', 'price', 'count'];
    use HasFactory;
}
