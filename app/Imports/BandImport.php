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

class BandImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {    
                    $insert = new Band(); 
                    $insert->insertOrIgnore([
                        'band_id' => $row['band_id'],
                        'band_nama' => $row['band_nama'],
                        'band_code' => $row['band_code'], 
                    ]); 
                 } 
        }
    }
}
