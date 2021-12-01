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

class TypeImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            if ($row->filter()->isNotEmpty()) {    
                    $insert = new TypeProduct(); 
                    $insert->insertOrIgnore([
                        'type_id' => $row['type_id'],
                        'type_name' => $row['type_name'],
                        'type_code' => $row['type_code'], 
                        'type_category' => $row['type_category'],
                    ]); 
                 } 
        }
    }
}
