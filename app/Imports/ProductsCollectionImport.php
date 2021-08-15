<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductLog;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;

class ProductsCollectionImport implements ToCollection
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    //  public $data; 

    public $data;
    protected $category_id;
    protected $user_id;

    public function __construct($category)
    {
        $this->category_id = $category;
        $this->user_id     = auth()->user()->id;
    }


    public function collection(Collection $rows)
    {

        Validator::make($rows->toArray(), [
            '*.0'  => 'required',
            '*.1'  => 'required',
            '*.2'  => 'required',
            '*.4'  => 'required',
            '*.5'  => 'required',
            '*.6'  => 'required',
            '*.9'  => 'required',
            '*.10' => 'required',
        ])->validate();

        // $this->data = $rows;
        // return $newOne;
        foreach ($rows as $index => $row) {
            if ($index <> 0) {
                $product = Product::create([
                    'owner_id'        => $this->user_id,
                    'category_id'     => $this->category_id,
                    'brand'           => $row[0],
                    'amount'          => $row[1],
                    'unit_price'      => $row[2],
                    // 'expiry_date'     => $row[3],
                    // 'expiry_date'     =>  Carbon::createFromFormat('Y-m-d', time())->timestamp,
                    'expiry_date'     => null,
                    'active'          => $row[4],
                    'ar'                  => [
                        'name'         => $row[5],
                        'description'  => $row[7],
                        'unit'         => $row[9],
                        'type'         => $row[11],
                    ],
                    'en'                   => [
                        'name'         => $row[6],
                        'description'  => $row[8],
                        'unit'         => $row[10],
                        'type'         => $row[12],
                    ],
                ]);

                ProductLog::create([
                    'product_id'      => $product->id,
                    'amount'          => $row[1],
                    'unit_price'      => $row[2],
                    // 'expiry_date'     => $row[3],
                    // 'expiry_date'     =>  Carbon::createFromFormat('Y-m-d', time())->timestamp,
                    'expiry_date'     => null,
                    'ar'                  => [
                        'name'         => $row[5],
                        'description'  => $row[7],
                        'unit'         => $row[9],
                        'type'         => $row[11],
                    ],
                    'en'                   => [
                        'name'         => $row[6],
                        'description'  => $row[8],
                        'unit'         => $row[10],
                        'type'         => $row[12],
                    ],
                ]);
            }
        }
    }


    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
}
