<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SlipGaji extends Model
{ 
    use HasFactory;
    protected $table = 'slipgaji';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'slipgaji_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
    'slipgaji_karyawanid',
    'slipgaji_userid',
    'slipgaji_bulan', 
    'slipgaji_tahun', 
    'slipgaji_kodeunik', 
    'slipgaji_komponenpenerimaan', 
    'slipgaji_komponenpotongan', 
    'slipgaji_thp', 
    'slipgaji_tanggalgaji', 
    'slipgaji_ttd', 
        'created_at',
        'updated_at', ];
}
