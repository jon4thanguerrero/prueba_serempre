<?php

namespace App\UseCases\Client;

use App\Repositories\Contracts\City\CityRepositoryInterface;
use App\Repositories\Contracts\Client\ClientRepositoryInterface;
use App\Services\Client\ImportClientExcelService;
use App\UseCases\Contracts\Client\ImportClientsUseCaseInterface;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\UploadedFile;

class ImportClientsUseCase implements ImportClientsUseCaseInterface
{
    public function __construct(
        private CityRepositoryInterface $cityRepository,
        private ClientRepositoryInterface $clientRepository,
        private ImportClientExcelService $importClientExcelService
    ) {
    }

    /**
     * @throws Exception
     */
    public function handle(UploadedFile $file): void
    {
        // Service that processes the information in excel and returns an array.
        $clientData = $this->importClientExcelService->handle($file);

        // Query to get the cities registered in BD
        $cities = $this->cityRepository->get();

        $clients = [];
        $numberClients = count($clientData);
        for ($i = 0; $i < $numberClients; $i++) {
            $clients[$i] = [
                'code'    => $clientData[$i][0],
                'name'    => $clientData[$i][1],
                'city_id' => $this->getCityID($cities, $clientData[$i][2]),
                'created_at'                  => Carbon::now(),
                'updated_at'                  => Carbon::now()
            ];
        }

        $createdClients = $this->clientRepository->saveFromImport($clients);

        if(!$createdClients) {
            throw new Exception('Error al almacenar los registros');
        }
    }

    /**
     * Method to get the city ID coming from the imported file
     */
    private function getCityID(Collection $cities, string $cityName): int
    {
        $city = $cities->first(function ($city) use ($cityName) {
            return $city->name === $cityName;
        });

        return $city->id;
    }
}
