<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublishCounter extends Model
{
    use HasFactory;

    protected $table = 'publishcount';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'publishcount_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
    'publishcount_pubid',
    'publishcount_count',
    'publishcount_pubtanggal',
        'created_at',
        'updated_at', ];
}
