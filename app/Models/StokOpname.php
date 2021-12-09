<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StokOpname extends Model
{
    use HasFactory;

    protected $table = 'stokopname';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'so_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['so_date',
        'so_pubgroupname',
        'so_mastersku',
        'so_sku',
        'so_sizeawal',
        'so_stokakhir',
        'so_stokgudang',
        'so_stoktoko',
        'so_stokakhirreal',
        'so_stokgudangreal',
        'so_stoktokoreal',
        'so_selisih',
        'so_keterangan',
        'so_type',
        'so_user',
        'so_status',
        'created_at',
        'updated_at', ];
}