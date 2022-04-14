<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Vendor;

class Product extends Model
{
    use HasFactory;
    protected $table = 'product';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'product_id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = ['product_barcodevendor',
    'product_mastersku',
    'product_sku',
    'product_nama',
    'product_vendor',
    'product_idsize',
    'product_idband',
    'product_hargajual',
    'product_hargabeli',
    'product_tag',
    'product_material',
    'product_madein',
    'product_condition',
    'product_foto',
    'product_stok',
    'product_color',
    'product_tanggalbeli',
    'product_stokakhir',
    'product_status',
    'product_tanggalpublish',
    'product_productlama',
    'product_barcodelama',
    'product_typeid',
    'product_keterangan',
        'created_at',
        'updated_at', ];


    public function setVendorNameAttribute($value)
    {
        $vendor_arr = array();
        foreach($value as $v){
            $vendorname = Vendor::where('vendor_id',$v)->first();
            array_push($vendor_arr, $vendorname->vendor_nama);
        }
        $nama = implode(",",$vendor_arr);
        $this->attributes['vendor_name'] = $nama;
    }

}
