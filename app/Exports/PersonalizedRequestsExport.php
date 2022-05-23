<?php

namespace App\Exports;

use App\Models\Request;
use Maatwebsite\Excel\Concerns\FromCollection;

use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;

use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Support\Facades\DB;


class PersonalizedRequestsExport implements FromQuery, WithHeadings, WithEvents, ShouldAutoSize
{
    use Exportable;

    public function __construct($date1, $date2, $status)
    {
        $this->date1 = $date1;
        $this->date2 = $date2;
        $this->status = $status;
    }

    public function query()
    {
        if($this->status == 'all')
        {
            $requests = DB::table('request')
                            ->join('client', 'client.id', '=', 'request.client_id')
                            ->select('client.name', 'client.email', 'client.telephone', 'request.id', 'request.status', 'request.note',
                                    'request.payment_method', 'request.total_of_request', 'request.canceled_for', 'request.created_at', 'request.time', 'request.updated_at')
                            ->where('request.status', '<>', 'RE')
                            ->whereBetween('request.created_at', array($this->date1, $this->date2))
                            ->orderBy('request.updated_at', 'DESC');
        }

        if($this->status == 'EC')
        {
            $requests = DB::table('request')
                            ->join('client', 'client.id', '=', 'request.client_id')
                            ->select('client.name', 'client.email', 'client.telephone', 'request.id', 'request.status', 'request.note',
                                    'request.payment_method', 'request.total_of_request', 'request.created_at', 'request.time', 'request.updated_at')
                            ->where('request.status', 'EC')
                            ->whereBetween('request.created_at', array($this->date1, $this->date2))
                            ->orderBy('request.updated_at', 'DESC');
        }

        if($this->status == 'EN')
        {
            $requests = DB::table('request')
                            ->join('client', 'client.id', '=', 'request.client_id')
                            ->select('client.name', 'client.email', 'client.telephone', 'request.id', 'request.status', 'request.note',
                                    'request.payment_method', 'request.total_of_request', 'request.created_at', 'request.time', 'request.updated_at')
                            ->where('request.status', 'EN')
                            ->whereBetween('request.created_at', array($this->date1, $this->date2))
                            ->orderBy('request.updated_at', 'DESC');
        }

        if($this->status == 'CA')
        {
            $requests = DB::table('request')
                            ->join('client', 'client.id', '=', 'request.client_id')
                            ->select('client.name', 'client.email', 'client.telephone', 'request.id', 'request.status', 'request.note',
                                    'request.payment_method', 'request.total_of_request', 'request.canceled_for', 'request.created_at', 'request.time', 'request.updated_at')
                            ->where('request.status', 'CA')
                            ->whereBetween('request.created_at', array($this->date1, $this->date2))
                            ->orderBy('request.updated_at', 'DESC');
        }

        return $requests;
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
        if($this->status != 'all' && $this->status != 'CA')
        {
            return [
                'Cliente',
                'Email',
                'Telefone',
                'Pedido Refer',
                'Status',
                'nota',
                'Forma de pagamento',
                'Total do pedido',
                'Criado em',
                'Hora',
                'Actualizado em'
            ];
        }

        if($this->status == 'all' || $this->status == 'CA')
        {
            return [
                'Cliente',
                'Email',
                'Telefone',
                'Pedido Refer',
                'Status',
                'nota',
                'Forma de pagamento',
                'Total do pedido',
                'Cancelado por',
                'Criado em',
                'Hora',
                'Actualizado em'
            ];
        }

    }

}
