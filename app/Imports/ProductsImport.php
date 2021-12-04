<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\Vendor;
use App\Models\Band;
use App\Models\Color;
use App\Models\Size;
use App\Models\TypeProduct;
use App\Models\BarcodeDB;
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

    public function generateMasterSKU($band, $type, $nama, $color){
        $databand = Band::where('band_id',$band)->first();
        $firstbandletter =  substr($databand->band_nama, 0, 1);
        $datatype = TypeProduct::where('type_id',$type)->first();
        $datacolor = Color::where('color_id',$color)->first();
        $sericode = BarcodeDB::where('barcode_productband',$band)->where('barcode_producttype',$type)->count();
        if($sericode < 10){
            if($sericode != 0) {
                $countseri = $sericode+1;
                $serivarian = "0".$countseri.$firstbandletter;
            }else {
            $countseri = 1;
            $serivarian = "0".$countseri.$firstbandletter;
            }
        }else {
            $countseri = $sericode+1;
            $serivarian = $countseri.$firstbandletter;
        }
        $mastersku = $databand->band_code.$datatype->type_code.$serivarian.$datacolor->color_code;
        return ["sku" => $mastersku, "seri" => $serivarian];
    }

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {
                $masterskus = $row['product_mastersku'];
                if($masterskus != NULL) {
                        $size = Size::where('size_id',$row['product_idsize'])->first();
                        $generatesize = Size::where('size_category',$size->size_category)->get();
                        $masterdata = BarcodeDB::where('barcode_mastersku', $masterskus)->first();
                        foreach($generatesize as $gs){
                            if($masterdata){
                        $skuvariant = $masterskus.$gs->size_id;
                        $checksku = Product::where('product_sku',$skuvariant)->first();
                                if($checksku == null){
                                    if(strlen($row['product_vendor']) > 1){
                                        $explodevendor = explode(',',$row['product_vendor']);
                                        $vendor = implode(',',$explodevendor);
                                    }else {
                                        $vendor = $row['product_vendor'];
                                    }
                                    if($row['product_idsize'] == $gs->size_id){
                                     $skuvariant = $masterskus.$row['product_idsize'];
                                     $stok = $row['product_stok'];
                                     $size = $row['product_idsize'];
                                    }else {
                                     $skuvariant = $masterskus.$gs->size_id;
                                     $stok = 0;
                                     $size = $gs->size_id;
                                    }
                                    try {
                                        if($stok >= 1){
                                            $stoktoko = 1;
                                            $stokgudang = (int)$stok-1;
                                        }elseif($stok <= 0){
                                            $stoktoko = 0;
                                            $stokgudang = 0;
                                        }

                                        $insert = new Product();
                                        $insert->insertOrIgnore([
                                            'product_productlama' => $row['product_productlama'],
                                            'product_barcodevendor' => $vendor,
                                            'product_mastersku' => $masterskus,
                                            'product_sku' => $skuvariant,
                                            'product_nama' => $masterdata->barcode_productname,
                                            'product_vendor' => $vendor,
                                            'product_idsize' =>  $row['product_idsize'],
                                            'product_idband'  => $masterdata->barcode_productband,
                                            'product_typeid'  => $masterdata->barcode_producttype,
                                            'product_color'  => $masterdata->barcode_productcolor,
                                            'product_hargajual' => $row['product_hargajual'],
                                            'product_hargabeli' => $row['product_hargabeli'],
                                            'product_tag' => $row['product_tag'],
                                            'product_material' => $row['product_material'],
                                            'product_madein' => $row['product_condition'],
                                            'product_foto' => $row['product_foto'],
                                            'product_stok' => $row['product_stok'],
                                            'product_stokakhir' => $row['product_stok'],
                                            'product_stoktoko' => $stoktoko,
                                            'product_stokgudang' => $stokgudang,
                                            'product_color' => $row['product_color'],
                                            'product_tanggalbeli' => $row['product_tanggalbeli'],
                                            'product_status' => $status,
                                            'product_tanggalpublish' => $row['product_tanggalpublish'],
                                        ]);
                                        } catch (QE $e) {
                                            return $e;
                                        }
                                }
                            }
                        }


                }else {
                    $checkbyname = BarcodeDB::where('barcode_productname','LIKE', '%'.$row['product_nama'].'%')
                    ->where('barcode_productband',$row['product_idband'])->first();
                    if($checkbyname){
                        $masterskus =  $checkbyname->barcode_mastersku;
                        $size = $row['product_idsize'];
                        $skuvariant = $masterskus.$size;
                        $checksku = Product::where('product_sku',$skuvariant)->first();
                        $masterdata = BarcodeDB::where('barcode_mastersku', $masterskus)->first();
                        if($masterdata){
                            if($checksku == null){
                                if(strlen($row['product_vendor']) > 1){
                                    $explodevendor = explode(',',$row['product_vendor']);
                                    $vendor = implode(',',$explodevendor);
                                }else {
                                    $vendor = $row['product_vendor'];
                                }
                                         if($row['product_tanggalpublish'] == NULL){
                                             $status = 0;
                                            }else {
                                             $status = 1;
                                             }
                                try {
                                    $insert = new Product();
                                    if($row['product_stok'] >= 1){
                                        $stoktoko = 1;
                                        $stokgudang = (int)$row['product_stok']-1;
                                        }elseif($row['product_stok'] <= 0){
                                            $stoktoko = 0;
                                            $stokgudang = 0;
                                        }
                                    $insert->insertOrIgnore([
                                        'product_productlama' => $row['product_productlama'],
                                        'product_barcodevendor' => $vendor,
                                        'product_mastersku' => $masterskus,
                                        'product_sku' => $skuvariant,
                                        'product_nama' => $masterdata->barcode_productname,
                                        'product_vendor' => $vendor,
                                        'product_idsize' =>  $row['product_idsize'],
                                        'product_idband'  => $masterdata->barcode_productband,
                                        'product_typeid'  => $masterdata->barcode_producttype,
                                        'product_color'  => $masterdata->barcode_productcolor,
                                        'product_hargajual' => $row['product_hargajual'],
                                        'product_hargabeli' => $row['product_hargabeli'],
                                        'product_tag' => $row['product_tag'],
                                        'product_material' => $row['product_material'],
                                        'product_madein' => $row['product_condition'],
                                        'product_foto' => $row['product_foto'],
                                        'product_stok' => $row['product_stok'],
                                        'product_stokakhir' => $row['product_stok'],
                                        'product_stoktoko' => $stoktoko,
                                        'product_stokgudang' => $stokgudang,
                                        'product_color' => $row['product_color'],
                                        'product_tanggalbeli' => $row['product_tanggalbeli'],
                                        'product_status' => $status,
                                        'product_tanggalpublish' => $row['product_tanggalpublish'],
                                    ]);
                                    } catch (QE $e) {
                                        return $e;
                                    }
                            }else {
                                $checksku->product_idsize = $row['product_idsize'];;
                                $checksku->product_idband = $masterdata->barcode_productband;
                                $checksku->product_typeid = $masterdata->barcode_producttype;
                                $checksku->product_color = $masterdata->barcode_productcolor;
                                $checksku->product_sku = $skuvariant;
                                $checksku->product_hargajual = $row['product_hargajual'];
                                $checksku->product_hargabeli = $row['product_hargabeli'];
                                $checksku->product_stok = (int)$checksku->product_stok + $row['product_stok'];
                                $checksku->product_stokakhir = (int)$checksku->product_stokakhir + $row['product_stok'];
                                if($row['product_stok'] >= 1){
                                $checksku->product_stoktoko = (int)$checksku->product_stoktoko+1;
                                $checksku->product_stokgudang = (int)$checksku->product_stokgudang+(int)$row['product_stok']-1;
                                }elseif($row['product_stok'] <= 0){
                                    $checksku->product_stoktoko = 0;
                                    $checksku->product_stokgudang = 0;
                                }
                                $checksku->product_foto = $row['product_foto'];;
                                if(is_array($row['product_vendor'])){
                                    $vendor = implode(',',$row['product_vendor']);
                                }else {
                                    $vendorinput = explode(' ',(string)$row['product_vendor']);
                                    $vendor = implode(',',$vendorinput);
                                }
                                $checksku->product_vendor = $vendor;
                                $checksku->product_productlama = $row['product_productlama'];
                            if($row['product_tanggalpublish'] == NULL){
                                $status = 0;
                            }else {
                                $status = 1;
                            }
                            $checksku->product_status = $status;
                            $checksku->update();
                            }
                        }

                    }else {
                        $masterdata = new BarcodeDB;
                        $masterdata->barcode_productband = $row['product_idband'];
                        $masterdata->barcode_producttype = $row['product_typeid'];
                        $masterdata->barcode_productcolor = $row['product_color'];
                        $masterdata->barcode_productname = $row['product_nama'];
                        $newbarcode = $this->generateMasterSKU($row['product_idband'],$row['product_typeid'],$row['product_nama'],$row['product_color']);
                        $masterdata->barcode_mastersku = $newbarcode["sku"];
                        $masterdata->barcode_productseri = $newbarcode["seri"];
                        $masterdata->save();
                        $skuvariant = $newbarcode["sku"].$row['product_idsize'];
                        if(strlen($row['product_vendor']) > 1){
                            $explodevendor = explode(',',$row['product_vendor']);
                            $vendor = implode(',',$explodevendor);
                        }else {
                            $vendor = $row['product_vendor'];
                        }
                        if($row['product_tanggalpublish'] == NULL){
                            $status = 0;
                        }else {
                            $status = 1;
                        }

                        try {
                            $insert = new Product();
                            if($row['product_stok'] >= 1){
                                $stoktoko = 1;
                                $stokgudang = (int)$row['product_stok']-1;
                                }elseif($row['product_stok'] <= 0){
                                    $stoktoko = 0;
                                    $stokgudang = 0;
                                }
                            $insert->insertOrIgnore([
                                'product_productlama' => $row['product_productlama'],
                                'product_barcodevendor' => $vendor,
                                'product_mastersku' => $newbarcode["sku"],
                                'product_sku' => $skuvariant,
                                'product_nama' => $masterdata->barcode_productname,
                                'product_vendor' => $vendor,
                                'product_idsize' =>  $row['product_idsize'],
                                'product_idband'  => $masterdata->barcode_productband,
                                'product_typeid'  => $masterdata->barcode_producttype,
                                'product_color'  => $masterdata->barcode_productcolor,
                                'product_hargajual' => $row['product_hargajual'],
                                'product_hargabeli' => $row['product_hargabeli'],
                                'product_tag' => $row['product_tag'],
                                'product_material' => $row['product_material'],
                                'product_madein' => $row['product_condition'],
                                'product_foto' => $row['product_foto'],
                                'product_stok' => $row['product_stok'],
                                'product_stokakhir' => $row['product_stok'],
                                'product_stoktoko' => $stoktoko,
                                'product_stokgudang' => $stokgudang,
                                'product_color' => $row['product_color'],
                                'product_tanggalbeli' => $row['product_tanggalbeli'],
                                'product_status' => $status,
                                'product_tanggalpublish' => $row['product_tanggalpublish'],
                            ]);
                            } catch (QE $e) {
                                return $e;
                            }
                    }

                }

            }
        }
    }
}
