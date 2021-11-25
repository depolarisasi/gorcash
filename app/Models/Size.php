<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $table = 'size';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'size_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['size_nama',
        'size_code',
        'created_at',
        'updated_at', ];
}
