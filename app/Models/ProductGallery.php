<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductGallery extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'product_id', 'image', 'is_default'
    ];

    protected $hidden = [];

    // relasi gallery
    public function product()
    {
        // produk galeri ini milik dari produk
        // (model::class, 'foreignkey','primary')
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // fungsi assesor untuk menambahkan text url di kolom image secara otomatis
    // url web kita
    // $value dari isi database itu sendiri
    public function getImageAttribute($value)
    {
        return url('storage/', $value);
    }
}
