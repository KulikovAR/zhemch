<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DancerGroup extends Model
{
    protected $fillable = ['dancer_id','group_id'];
    use HasFactory;
}
