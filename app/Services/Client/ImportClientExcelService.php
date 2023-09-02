<?php

namespace App\Services\Client;

use Illuminate\Http\UploadedFile;
use PhpOffice\PhpSpreadsheet\IOFactory;

class ImportClientExcelService
{
    /**
     * returns an array each with the data retrieved per row
     * 
     * @return array
     * 
     * [
     *      [
     *          0 => "df23edsd"
     *          1 => "primavera"
     *          2 => "Bogota"
     *      ],
     *      [
     *          0 => "lkcvm123"
     *          1 => "andino"
     *          2 => "Bogota"
     *      ]    
     * ]
     */
    public function handle(UploadedFile $file): array
    {
        $spreadsheet = IOFactory::load($file);
        $worksheet = $spreadsheet->getActiveSheet();
        $rows = $worksheet->getRowIterator();

        // the following instruction is carried out so that it starts in the second row
        // in the first row is the name of each column. Example: code, name, city
        $rows->next();

        $fileData = [];

        while ($rows->valid()) {
            $row = $rows->current();
            $rowData = [];

            foreach ($row->getCellIterator() as $cell) {
                $rowData[] = $cell->getValue();
            }

            $fileData[] = $rowData;  

            $rows->next();
        }

        return $fileData;
    }
}
