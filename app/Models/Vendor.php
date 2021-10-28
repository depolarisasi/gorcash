<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    /*
    **
    * The database table used by the model.
    *
    * @var string
    */
    protected $table = 'vendor';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'vendor_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['vendor_nama',
        'vendor_web',
        'vendor_asal',
        'created_at',
        'updated_at', ];
}
