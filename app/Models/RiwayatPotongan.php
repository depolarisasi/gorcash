<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RiwayatPotongan extends Model
{
    use HasFactory;

    protected $table = 'riwayatpotongan';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'riwayatpotongan_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
    'riwayatpotongan_namapotongan',
    'riwayatpotongan_jumlahpotongan',
    'riwayatpotongan_idpenjualan',
    'riwayatpotongan_tanggalriwayatpotongan',
    'riwayatpotongan_userid',
        'created_at',
        'updated_at', ];
}
