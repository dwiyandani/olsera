<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pajak extends Model
{
    use HasFactory;

    protected $table = "pajak";
    protected $guarded = ['id'];

    protected $hidden = ['created_at', 'updated_at','item_id'];
}