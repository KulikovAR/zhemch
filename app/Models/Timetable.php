<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Timetable extends Model
{
    protected $fillable = ['group_id', 'dancer_id', 'time_start', 'time_end', 'day','room', 'comment', 'def'];
    use HasFactory;
}
