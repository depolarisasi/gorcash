<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Informasi extends Model
{
    use HasFactory;
    protected $table = 'informasi';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'informasi_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['informasi_judul',
        'informasi_isi',
        'informasi_date',
        'created_at',
        'updated_at', ];
}
