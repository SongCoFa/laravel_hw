<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ['username_from', 'username_to', 'content', 'title', 'userid_from', 'userid_to','created_at','updated_at'];
    protected $guarded = ['id'];
    protected $hidden = ['created_at'];
}
