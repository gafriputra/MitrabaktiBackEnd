<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
// pakai softdelete
use Illuminate\Database\Eloquent\SoftDeletes;



class Product extends Model
{

    use SoftDeletes;

    // filllable gunanya untuk jika insert data, kita bisa langsung assign
    // data apa saja yang kita insert secara langsung

    protected $fillable = [
        'name', 'type', 'description', 'price', 'slug', 'quantity'
    ];

    // hidden gunanya untuk ada beberapa variabel yang gamau dimunculin, dimasukkan kesini
    protected $hidden = [];

    // bikin relasi ke gallery
    public function galleries()
    {
        return $this->hasMany(ProductGallery::class, 'product_id');
    }
}
