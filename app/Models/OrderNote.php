<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderNote extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['user_id','order_id','reply_id','note'];
}
