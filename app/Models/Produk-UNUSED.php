<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;


    protected $table = 'produk';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'produk_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['produk_nama',
        'produk_sku',
        'produk_idvendor',
        'produk_idsize',
        'produk_idband',
        'produk_hargajual',
        'produk_hargabeli',
        'produk_foto',
        'produk_stok',
        'produk_tanggalbeli',
        'created_at',
        'updated_at', ];

}
