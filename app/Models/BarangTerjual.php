<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BarangTerjual extends Model
{
    use HasFactory;

    protected $table = 'barangterjual';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'barangterjual_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['barangterjual_idproduk',
    'barangterjual_idpenjualan',
    'barangterjual_qty',
    'barangterjual_totalbarangterjual',
    'barangterjual_diskon',
    'barangterjual_totalpendapatan',
    'barangterjual_tanggalbarangterjual',
    'barangterjual_userid',
        'created_at',
        'updated_at', ];
}
