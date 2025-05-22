<?php

namespace App\Models;
use App\Models\ProductLog;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        "name",
        "category",
        "quantity",
        "price",
        "description",
    ];
        protected static function booted()
    {
        static::created(function ($product) {
            ProductLog::create([
                'product_id' => $product->id,
                'name' => $product->name,
                'action' => 'Tạo',
                'performed_at' => now(),
            ]);
        });

        static::updated(function ($product) {
            ProductLog::create([
                'product_id' => $product->id,
                'name' => $product->name,
                'action' => 'Cập Nhật',
                'performed_at' => now(),
            ]);
        });

        static::deleted(function ($product) {
            ProductLog::create([
                'product_id' => $product->id,
                'name' => $product->name,
                'action' => 'Xóa',
                'performed_at' => now(),
            ]);
        });
    }
}
