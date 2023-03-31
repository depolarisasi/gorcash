<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Karyawan extends Model
{
    use HasFactory;
    protected $table = 'karyawan';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'karyawan_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
    'karyawan_jabatan',
    'karyawan_noinduk',
    'karyawan_nama',
    'karyawan_kelamin',
    'karyawan_tempatlahir',
    'karyawan_tanggallahir',
    'karyawan_kewarganegaraan',
    'karyawan_nik',
    'karyawan_bpjs',
    'karyawan_status',
    'karyawan_agama',
    'karyawan_alamatsekarang',
    'karyawan_kotasekarang',
    'karyawan_provinsisekarang',
    'karyawan_alamatktp',
    'karyawan_kotaktp',
    'karyawan_provinsiktp',
    'karyawan_nohp',
    'karyawan_email',
    'karyawan_namabank',
    'karyawan_cabangbank',
    'karyawan_norekbank',
    'karyawan_namarekbank',
    'karyawan_pendidikanterakhir',
    'karyawan_pendidikan1',
    'karyawan_jurusanpendidikan1',
    'karyawan_tahunpendidikan1',
    'karyawan_kualifikasipendidikan1',
    'karyawan_pendidikan2',
    'karyawan_jurusanpendidikan2',
    'karyawan_tahunpendidikan2',
    'karyawan_kualifikasipendidikan2',
    'karyawan_bahasa1',
    'karyawan_mendengarbahasa1',
    'karyawan_berbicarabahasa1',
    'karyawan_membacabahasa1',
    'karyawan_menulisbahasa1',
    'karyawan_bahasa2',
    'karyawan_mendengarbahasa2',
    'karyawan_berbicarabahasa2',
    'karyawan_membacabahasa2',
    'karyawan_menulisbahasa2',
    'karyawan_employment1',
    'karyawan_employmentperiode1',
    'karyawan_employmentjabatan1',
    'karyawan_employmentgaji1',
    'karyawan_employment2',
    'karyawan_employmentperiode2',
    'karyawan_employmentjabatan2',
    'karyawan_employmentgaji2',
    'karyawan_cacat',
    'karyawan_merokok',
    'karyawan_namaayah',
    'karyawan_telpayah',
    'karyawan_alamatayah',
    'karyawan_namaibu',
    'karyawan_telpibu',
    'karyawan_alamatibu',
    'karyawan_haritertentu',
    'karyawan_sim',
    'karyawan_jenissim',
    'karyawan_berlakusim',
    'karyawan_pernahdiberhentikan',
    'karyawan_pernahdihukum',
    'karyawan_namasdr',
    'karyawan_telpsdr',
    'karyawan_alamatsdr',
    'karyawan_kontakdrt1',
    'karyawan_nokontakdrt1',
    'karyawan_foto',
    'karyawan_fotoktp',
    'karyawan_tanggalbekerja',
    'karyawan_userid',
    'karyawan_jammasukkerja',
    'karyawan_upahharian',
    'karyawan_upahpokok',
        'created_at',
        'updated_at', ];

        function foto(){
            return $this->belongsTo('App\User');
        }
}
