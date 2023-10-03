<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanDana extends Model
{
    use HasFactory;
    protected $table = 'pengajuandana';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'pengajuandana_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['pengajuandana_nama',
        'pengajuandana_pengajuan', 
        'pengajuandana_category', 
        'pengajuandana_bulan', 
        'pengajuandana_tahun', 
        'pengajuandana_group', 
        'created_at',
        'updated_at', ];
}
