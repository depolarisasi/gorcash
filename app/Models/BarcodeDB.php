<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarcodeDB extends Model
{
    use HasFactory;


    protected $table = 'barcode';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'barcode_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['barcode_mastersku',
        'barcode_productname',
        'barcode_producttype',
        'barcode_productcolor',
        'barcode_productsize',
        'barcode_productband',
        'barcode_productseri',
        'created_at',
        'updated_at', ];
}
