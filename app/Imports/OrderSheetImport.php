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


class OrderSheetImport implements ToCollection
{
    protected $order_id;

    public function __construct($order_id)
    {
        $this->order_id    = $order_id;
    }

    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $rows)
    {
        foreach ($rows as $index => $row) {
            if ($index <> 0 ) {
                $product =  Product::whereTranslationLike('name', "%" . $row[0] . "%")->whereTranslationLike('type', "%" . $row[1] . "%")
                ->where('active', 1)->first();
                
                if( !is_null($product) )
                    OrderProduct::create([
                        'product_id'        => $product->id,
                        'order_id'          => $this->order_id,
                        'amount'            => $row[2],
                        'unit'              => $row[3],
                        'note'              => $row[4],
                    ]);
            }
        }
    }

    public function validat($rows)
    {
        Validator::make($rows->toArray(), [
            '*.0'  => 'required|max:191',
            '*.1'  => 'required|max:191',
            '*.2'  => 'required|integer|min:1',
            '*.3'  => 'required|string|max:191',
            '*.4'  => 'nullable|max:400',
        ])->validate();
    }
}
