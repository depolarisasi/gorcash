<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TurunBarang extends Model
{
    use HasFactory;

    protected $table = 'barangturun';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'barangturun_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['barangturun_sku',
        'barangturun_mastersku',
        'barangturun_namapetugas',
        'barangturun_tanggalambil',
        'barangturun_tanggalkembali',
        'created_at',
        'updated_at', ];
}
