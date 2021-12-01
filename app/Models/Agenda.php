<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory; 

    protected $table = 'agenda';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'agenda_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['agenda_judul',
        'agenda_isi',
        'agenda_startdate',
        'agenda_enddate',
        'created_at',
        'updated_at', ];
}
