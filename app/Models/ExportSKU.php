<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExportSKU extends Model
{
    use HasFactory;
    protected $table = 'exportsku';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'exportsku_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['exportsku_name',
        'exportsku_productsku',
        'exportsku_tanggal',
        'exportsku_groupid',
        'created_at',
        'updated_at', ];
}
