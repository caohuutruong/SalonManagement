<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductLog extends Model
{
   protected $fillable = [
    'product_id',
    'name',
    'action',
    'performed_at',
    'note',
];
}
