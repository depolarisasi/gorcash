<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workflow extends Model
{
    use HasFactory;

    protected $table = 'workflow';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'workflow_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['workflow_nama',
        'workflow_isi',
        'workflow_date',
        'created_at',
        'updated_at', ];
}
