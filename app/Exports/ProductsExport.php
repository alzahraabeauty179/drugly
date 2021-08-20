<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ProductsExport implements Responsable, FromQuery, WithHeadings
{
    use Exportable;

    protected $id;
    public $data;
    public function __construct(int $id)
    {
        $this->id = $id;
    }

    /**
     * It's required to define the fileName within
     * the export class when making use of Responsable.
     */
    private $fileName = 'product.xlsx';

    /**
     * Optional Writer Type
     */
    private $writerType = Excel::XLSX;

    /**
     * Optional headers
     */
    private $headers = [
        'Content-Type' => 'text/csv',
    ];

    public function headings(): array
    {
        return [
            'id',
            'brand',
            'amount',
            'unit_price',
            'expiry_date',
            'active',
            'name',
            'desccription',
            'unit',
            'type',
        ];
    }
    public function select(): array
    {
        return [
            'id',
            'brand',
            'amount',
            'unit_price',
            'expiry_date',
            'active',
        ];
    }

    public function query()
    {
        return Product::query()->where('category_id', $this->id)->select($this->select());


        // return Product::where('category_id',$this->id)->get();
        // return DB::select(" SELECT products.*, a1.name as 'ar_name' , a1.description as 'ar_desc', a2.name as 'en_name', a2.description as 'en_desc'
        //                     FROM `products`
        //                     join product_translations as a1
        //                     ON products.id = a1.product_id
        //                     join product_translations as a2
        //                     ON products.id = a2.product_id
        //                     where a1.locale = 'ar'
        //                     AND a2.locale = 'en'
        //                     AND products.category_id = ? ", [$this->id] );
    }
}
