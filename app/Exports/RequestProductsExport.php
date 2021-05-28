<?php

namespace App\Exports;

use App\Models\RequestProduct;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;


class RequestProductsExport implements FromQuery, WithHeadings, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function __construct($request_id)
    {
        $this->request_id = $request_id;
    }

    public function query()
    {
        $requestProducts = DB::table('request_product')

        ->join('product_tb', 'product_tb.id', '=', 'request_product.product_id')

        ->select('product_tb.name', 'request_product.status', 'request_product.value', 'request_product.qtd',

        'request_product.total_of_request_product', 'request_product.created_at', 'request_product.time', 'request_product.updated_at')

        ->where('request_product.request_id', '=', $this->request_id)

        ->orderBy('request_product.updated_at', 'DESC');

        return $requestProducts;
    }


    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function(AfterSheet $event){
                $cellRange = 'A1:W1'; // ALL HEADERS
                $event->sheet->getDelegate()->getStyle($cellRange)->getFont()->setSize(14);
            },
        ];
    }

    public function headings(): array
    {
        return [
            'Produto',
            'Status',
            'Preço',
            'Qtd',
            'Total',
            'Criado em',
            'Hora',
            'Actualizado em',
        ];

    }

}
