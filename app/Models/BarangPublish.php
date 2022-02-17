<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangPublish extends Model
{
    use HasFactory;

    protected $table = 'publish';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'publish_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['publish_productid',
    'publish_tanggal',
    'publish_groupid',
    'publish_name',
    'publish_stok',
    'publish_stokakhir',
        'created_at',
        'updated_at', ];
}
