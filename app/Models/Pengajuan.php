<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pengajuan extends Model
{
    use HasFactory;
    protected $table = 'systemsetting';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'setting_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['setting_name',
        'setting_value',
        'setting_option',
        'created_at',
        'updated_at', ];
}
