<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KirimPaket extends Model
{
    use HasFactory;
    protected $table = 'kirimpaket';

    /**
     * The database primary key value.
     * 
     * @var string
     */
    protected $primaryKey = 'kirimpaket_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['kirimpaket_user',
        'kirimpaket_tanggal',
        'kirimpaket_waktupengiriman',
        'kirimpaket_jumlahpaket',
        'created_at',
        'updated_at', ];
}
