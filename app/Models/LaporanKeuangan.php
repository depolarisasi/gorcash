<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LaporanKeuangan extends Model
{
    use HasFactory;
    protected $table = 'laporankeuangan';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'laporankeuangan_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['laporankeuangan_nama',
        'laporankeuangan_kategori',
        'laporankeuangan_bulan',
        'laporankeuangan_tahun',
        'laporankeuangan_link',
        'created_at',
        'updated_at', ];
}
