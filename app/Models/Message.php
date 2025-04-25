<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['username', 'content', 'title'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at'];
}
