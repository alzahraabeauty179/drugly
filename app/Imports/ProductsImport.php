<?php

namespace App\Imports;

use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public $data;
    public function model(array $row)
    {
        return new Product([
            'owner_id'        => auth()->user()->id,
            'category_id'     => $row['category_id'],
            'brand_id'        => $row['brand_id'],
            'amount'          => $row['amount'],
            'unit_price'      => $row['unit_price'],
            // // 'expiry_date'     => $row['expiry_date'],
            // 'expiry_date'     =>  Carbon::createFromFormat('Y-m-d', time())->timestamp,
            'expiry_date'     => null,
            'active'          => $row['active'],
            'ar'                  => [
                'name'         => $row['name_ar'],
                'description'  => $row['desc_ar'],
                'unit'         => $row['unit_ar'],
                'type'         => $row['type_ar'],
            ],
            'en'                   => [
                'name'         => $row['name_en'],
                'description'  => $row['desc_en'],
                'unit'         => $row['unit_en'],
                'type'         => $row['type_en'],
            ],

        ]);
    }
}
