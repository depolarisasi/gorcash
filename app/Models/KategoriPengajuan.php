<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriPengajuan extends Model
{
    use HasFactory;
    protected $table = 'catpengajuan';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'catpengajuan_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['catpengajuan_nama',
        'catpengajuan_pengajuan', 
        'created_at',
        'updated_at', ];
}
