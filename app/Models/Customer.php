<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customer';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'customer_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['customer_nama',
    'customer_nohp',
        'customer_email',
        'customer_points',
        'created_at',
        'updated_at', ];
}
