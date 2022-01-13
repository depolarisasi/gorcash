<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Logs extends Model
{
    use HasFactory;
    protected $table = 'log';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'log_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['log_name',
    'log_msg',
    'log_tanggal',
    'log_userid',
    'created_at',
    'updated_at'];
}
