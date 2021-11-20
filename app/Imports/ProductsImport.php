<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToCollection, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {
                $size = [1 => "S",2 => "M",3 => "L",4 => "XL", 5 => "2XL"];
                foreach($size as $key => $s){
                    $skuvariant = $row['product_mastersku'].$key;
                    $checksku = Product::where('product_sku',$skuvariant)->first();
                        if($checksku == null){
                          if($row['product_idsize'] == $key){
                            $idsize = $key;
                          $stok = $row['product_stok'];
                          $stokakhir = $row['product_stokakhir'];
                          }else {
                         $idsize = $key;
                         $stok = 0;
                         $stokakhir = 0;
                         }

                         $vendor = $row['product_vendor'];


                         if($request->product_tanggalpublish == NULL){
                        $status = 0;
                         }else {
                        $status = 1;
                         }
                         $insert = new Product();
                         $insert->insertOrIgnore([
                             'product_barcodevendor' => $row['product_barcodevendor'],
                             'product_mastersku' => $row['product_mastersku'],
                             'product_sku' => $skuvariant,
                             'product_nama' => $row['product_nama'],
                             'product_vendor' => $vendor,
                             'product_idsize' => $idsize,
                             'product_idband'  => $row['product_idband'],
                             'product_hargajual' => $row['product_hargajual'],
                             'product_hargabeli' => $row['product_hargabeli'],
                             'product_tag' => $row['product_tag'],
                             'product_material' => $row['product_material'],
                             'product_madein' => $row['product_condition'],
                             'product_foto' => $row['product_foto'],
                             'product_stok' => $stok,
                             'product_color' => $row['product_color'],
                             'product_tanggalbeli' => $row['product_tanggalbeli'],
                             'product_stokakhir' => $stokakhir,
                             'product_status' => $status,
                             'product_tanggalpublish' => $row['product_tanggalpublish'],
                         ]);

                 }

                }
            }
        }
    }
}
