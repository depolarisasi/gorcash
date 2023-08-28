<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PointLog extends Model
{
    use HasFactory;
    protected $table = 'points_log';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['user_id',
        'points',
        'type',
        'user_points_id',
        'order_id',
        'admin_user_id',
        'data',
        'date',
        'created_at',
        'updated_at',];
}
