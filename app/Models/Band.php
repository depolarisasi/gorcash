<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Band extends Model
{
    use HasFactory;
    protected $table = 'band';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'band_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['band_nama',
    'band_code',
        'created_at',
        'updated_at', ];
}
