<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dancers extends Model
{
    protected $fillable = ['name', 'birth', 'parent_name', 'phone', 'comment', 'viber_phone', 'class_count', 'balance'];
    use HasFactory;
}
