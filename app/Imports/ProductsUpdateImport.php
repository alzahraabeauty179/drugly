<?php

namespace App\Imports;

use App\Models\Product;
use App\Models\ProductLog;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\ToCollection;


class ProductsUpdateImport implements ToCollection
{

    protected $category_id;
    protected $user_id;
    protected $store_id;

    public function __construct($category)
    {
        $this->category_id = $category;
        $this->user_id     = auth()->user()->id;
        $this->store_id    = auth()->user()->store_id;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        // $this->validat($rows);
        foreach ($rows as $index => $row) {
            if ($index <> 0) {
                $product = Product::updateOrCreate(
                    [
                        'id'              => $row[0],
                    ],
                    [
                        'owner_id'        => $this->user_id,
                        'category_id'     => $this->category_id,
                        'brand'           => $row[1],
                        'amount'          => $row[2],
                        'unit_price'      => $row[3],
                        // 'expiry_date'     => $row[4],
                        // 'expiry_date'     =>  Carbon::createFromFormat('Y-m-d', time())->timestamp,
                        'expiry_date'     => null,
                        'active'          => $row[5],
                        App::getLocale()     => [
                                'name'         => $row[6],
                                'description'  => $row[7],
                                'unit'         => $row[8],
                                'type'         => $row[9],
                            ],
                    ]
                );

                ProductLog::create([
                    'product_id'      => $product->id,
                    'amount'          => $row[2],
                    'unit_price'      => $row[3],
                    // 'expiry_date'     => $row[4],
                    // 'expiry_date'     =>  Carbon::createFromFormat('Y-m-d', time())->timestamp,
                    'expiry_date'     => null,
                    App::getLocale()     => [
                        'name'         => $row[6],
                        'description'  => $row[7],
                        'unit'         => $row[8],
                        'type'         => $row[9],
                    ],
                ]);
            }
        }
    }

    public function validat($rows)
    {
        Validator::make($rows->toArray(), [
            '*.0'  => ['nullable',  Rule::exists('products')->where(function ($query) {
                $query->where('store_id', $this->store_id);
            }),],
            '*.1'  => 'required',
            '*.2'  => 'required',
            '*.3'  => 'required|min',
            '*.5'  => 'required|integer|between:1,2',
            '*.6'  => 'required|max:200',
            '*.7'  => 'required|max:500',
            '*.8'  => 'required',
            '*.9' => 'required',
        ])->validate();
    }
}
