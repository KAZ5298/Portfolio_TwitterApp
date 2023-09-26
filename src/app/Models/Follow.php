<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Follow extends Model
{
    use HasFactory;

    protected $primaryKey = [
        'following_id',
        'followed_id'
    ];

    protected $fillable = [
        'following_id',
        'followed_id'
    ];

    public $timestamps = false;
    public $incrementing = false;
}
