<?php

namespace App\Services\Client\Exports;

use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;

class ClientsExport implements FromCollection
{
    use Exportable;

    // protected $clients;

    public function __construct(private Collection $clients)
    {
    }

    public function collection()
    {
        return $this->clients;
    }

    public function headings(): array
    {
         $headings =[
            'ID',
            'Code',
            'Name',
            'City',
        ];

        return $headings;
    }
}