<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notes extends Model
{
    use HasFactory;


    protected $table = 'note';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'note_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['note_judul',
        'note_isi',
        'note_date',
        'created_at',
        'updated_at', ];
}
