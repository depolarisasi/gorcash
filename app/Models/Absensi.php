<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;
    protected $table = 'absensi';

    /**
     * The database primary key value.
     * @var string
     */
    protected $primaryKey = 'absensi_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['absensi_karyawanid',
    'absensi_tanggal',
    'absensi_jammasuk',
    'absensi_jampulang',
    'absensi_lembur',
    'absensi_type',
    'absensi_lamakerja',
    'absensi_keterangan',
    'absensi_keterlambatan',
        'created_at',
        'updated_at', ];
}
