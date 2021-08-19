<?php

namespace App\Exports;

use App\Models\Product;
use Maatwebsite\Excel\Excel;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ProductsExport implements Responsable, FromQuery, WithHeadings
{
    use Exportable;

    protected $id;
    public $data ;
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
            'id' ,
            'brand',
            'amount',
            'unit_price',
            'expiry_date',
            'active',
            // 'name_ar' ,
            // 'name_en',
            // 'desc_ar',
            // 'desc_en',
            // 'unit_ar',
            // 'unit_en',
            // 'type_ar',
            // 'type_en',
        ];
    }

    public function query()
    {
        return Product::query()->where('category_id',$this->id)->select( $this->headings() );
        // ->select('id', 'brand', 'amount', 'unit_price', 'active')
        //         ->join('product_translations', 'products.id', '=', 'product_translations.product_id')
        //         ->select('name as name_ar','description as desc_ar', 'unit as unit_ar', 'type as type_ar')->where('product_translations.locale', 'ar')
        //         ->select('name as name_en','description as desc_en', 'unit as unit_en', 'type as type_en')->where('product_translations.locale', 'en')
               
        // return $this->data;
    }

}
