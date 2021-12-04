<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use App\Models\Product;
use App\Models\Vendor;
use App\Models\Band;
use App\Models\Color;
use App\Models\TypeProduct;
use App\Models\BarcodeDB;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class BarcodeImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
        if ($row->filter()->isNotEmpty()) {
            $checkbarcode = BarcodeDB::where('barcode_mastersku',$row['barcode_mastersku'])->first();
            if(is_null($checkbarcode)){
                    $insert = new BarcodeDB();
                    $insert->insertOrIgnore([
                        'barcode_id' => $row['barcode_id'],
                        'barcode_mastersku' => $row['barcode_mastersku'],
                        'barcode_productname' => $row['barcode_productname'],
                        'barcode_producttype' => $row['barcode_producttype'],
                        'barcode_productcolor' => $row['barcode_productcolor'],
                        'barcode_productband' => $row['barcode_productband'],
                        'barcode_productseri' => $row['barcode_productseri'],
                    ]);

            }
        }
     }
    }
}
