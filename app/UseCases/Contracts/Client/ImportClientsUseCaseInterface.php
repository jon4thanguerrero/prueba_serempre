<?php

namespace App\UseCases\Contracts\Client;

use Illuminate\Http\UploadedFile;

interface ImportClientsUseCaseInterface
{
    public function handle(UploadedFile $file): void;
}
