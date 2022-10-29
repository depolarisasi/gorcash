<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KomponenGaji extends Model
{
    use HasFactory; 
    protected $table = 'gaji';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'gaji_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
    'gaji_slipid',
    'gaji_kodeunik',
    'gaji_typekomponen', 
    'gaji_jumlah', 
        'created_at',
        'updated_at', ];
}
