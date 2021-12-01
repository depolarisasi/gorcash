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

class VendorImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {    
                    $insert = new Vendor(); 
                    $insert->insertOrIgnore([
                        'vendor_id' => $row['vendor_id'],
                        'vendor_nama' => $row['vendor_nama'],
                        'vendor_web' => $row['vendor_web'], 
                        'vendor_asal' => $row['vendor_asal'],
                    ]); 
                 } 
        }
    }
}
