<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjualan extends Model
{

    use HasFactory;

    protected $table = 'penjualan';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'penjualan_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['penjualan_invoice',
    'penjualan_invoicegorilla',
    'penjualan_customername',
    'penjualan_channel',
    'penjualan_barangterjual',
    'penjualan_totalpenjualan',
    'penjualan_daftarpotongan',
    'penjualan_totalpotongan',
    'penjualan_tanggalpenjualan',
    'penjualan_diskon',
    'penjualan_totalpendapatan',
    'penjualan_receipt',
    'penjualan_paymentype',
    'penjualan_paymenttotal',
    'penjualan_userid',
        'created_at',
        'updated_at', ];
}
