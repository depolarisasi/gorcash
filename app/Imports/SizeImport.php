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
use App\Models\Size;
use Carbon\Carbon;  
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SizeImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
 
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {    
                    $insert = new Size(); 
                    $insert->insertOrIgnore([
                        'size_id' => $row['size_id'],
                        'size_nama' => $row['size_nama'],
                        'size_code' => $row['size_code'],
                        'size_category' => $row['size_category'], 
                    ]); 
                 } 
        }
    }
}
