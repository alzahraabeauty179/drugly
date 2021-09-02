<?php

namespace App\Imports;

use App\Models\Order;
use App\Models\Product;
use App\Models\OrderProduct;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;


class SearchSheetImport implements ToCollection
{
    public $data;

    public function __construct()
    {
        //
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        $products = [];

        foreach ($rows as $index => $row) {
            if ($index <> 0) {
                $product =  Product::whereTranslationLike('name', "%" . $row[0] . "%")->whereTranslationLike('type', "%" . $row[1] . "%")
                ->where('amount', '>=', $row[2])->where('active', 1)->pluck('id');
                
                if( is_null($product) )
                {
                    $product2 = Product::whereTranslationLike('name', "%" . $row[0] . "%")->whereTranslationLike('type', "%" . $row[1] . "%")
                    ->where('amount', '<=', $row[2])->where('active', 1)->pluck('id');

                    if( !is_null($product2) )
                        array_push($products, $product);
                }
                else
                    array_push($products, $product);
            }
        }
        
        $this->data = $products;
 
    }

    public function validat($rows)
    {
        Validator::make($rows->toArray(), [
            '*.0'  => 'required|max:191',
            '*.1'  => 'required|max:191',
            '*.2'  => 'required|integer|min:1'
        ])->validate();
    }
}
