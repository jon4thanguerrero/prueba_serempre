<?php

namespace App\UseCases\Client;

use App\Repositories\Contracts\Client\ClientRepositoryInterface;
use App\Services\Client\ExportClientExcelService;
use App\UseCases\Contracts\Client\ExportClientsUseCaseInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ExportClientsUseCase implements ExportClientsUseCaseInterface
{
    public function __construct(
        private ClientRepositoryInterface $clientRepository,
        private ExportClientExcelService $exportClientExcelService
    ) {
    }

    public function handle(): BinaryFileResponse
    {
        $clients = $this->clientRepository->getAll();
        
        return $this->exportClientExcelService->handle($clients);
    }
}
