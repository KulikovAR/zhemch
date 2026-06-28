<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $fillable = ['timetable_id', 'group_id', 'dancers_id', 'user_id'];
    use HasFactory;
}
