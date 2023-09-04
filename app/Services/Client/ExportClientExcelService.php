<?php

namespace App\Services\Client;

use App\Services\Client\Exports\ClientsExport;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportClientExcelService
{
    public function handle(Collection $clients): BinaryFileResponse
    {
        return Excel::download(new ClientsExport($clients), 'clients.xlsx');
    }
}
