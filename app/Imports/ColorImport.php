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


class ColorImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {    
                    $insert = new Color(); 
                    $insert->insertOrIgnore([
                        'color_id' => $row['color_id'],
                        'color_nama' => $row['color_nama'],
                        'color_code' => $row['color_code'], 
                    ]); 
                 } 
        }
    }
}
