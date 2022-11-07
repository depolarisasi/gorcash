<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Surat extends Model
{
    use HasFactory;
    protected $table = 'surat';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'surat_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['surat_nama',
        'surat_link',
        'created_at',
        'updated_at', ];
}
