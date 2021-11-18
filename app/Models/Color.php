<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    use HasFactory;
    protected $table = 'color';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'color_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['color_nama',
        'color_code',
        'created_at',
        'updated_at', ];
}
