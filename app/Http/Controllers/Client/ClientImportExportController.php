<?php

namespace App\Http\Controllers\Client;

use App\UseCases\Contracts\Client\ImportClientsUseCaseInterface;
use Illuminate\Contracts\View\View as ViewContract;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\View;
use Throwable;

class ClientImportExportController extends Controller
{
    public function __construct(
        private ImportClientsUseCaseInterface $importClientsUseCase
    ) {
    }

    public function index(): ViewContract
    {
        return View::make('clients.import-clients');
    }

    public function import(Request $request): ViewContract
    {
        $validator = Validator::make($request->all(), [
            'file_excel' => 'required|mimes:xlsx,xls',
        ]);

        if($validator->fails()) {
            return View::make('clients.import-clients', ['message' => 'Error al validar el archivo', 'success' => 0]);
        }

        try {
            $file = $request->file('file_excel');

            app('db')->beginTransaction();

            $this->importClientsUseCase->handle($file);

            app('db')->commit();

            return View::make('clients.import-clients', ['message' => 'Registro exitoso', 'success' => 1]);
        } catch (Throwable $th) {
            app('db')->rollback();

            Log::error($th->getMessage(), $th->getTrace());

            return View::make('clients.import-clients', ['message' => 'Error en el proceso de importacion de clientes', 'success' => 0]);
        }

        return response()->json();
    }
}
