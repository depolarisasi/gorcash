<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProduct extends Model
{
    use HasFactory;
    protected $table = 'type';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'type_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['type_name',
        'type_code',
        'created_at',
        'updated_at', ];
}
