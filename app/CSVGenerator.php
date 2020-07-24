<?php

declare(strict_types=1);

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CSVGenerator extends Model
{
    /**
     * generate csv streamed response from given array
     *
     * @param array $rows - all row data
     * @param array $columns - columns for the columns
     * @param string $title - title to use for the csv export, with default
     *
     * @return StreamedResponse
     */
    public function generate(array $rows, array $columns, $title = 'csv-export.csv'): StreamedResponse
    {
        return new StreamedResponse(function () use ($rows, $columns) {

            $handle = fopen('php://output', 'w');

            // add headers
            fputcsv($handle, $columns);

            // add rows
            foreach ($rows as $row) {
                fputcsv($handle, $row);
            }

            // close it out
            fclose($handle);

        }, 200, [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $title . '"',
        ]);
    }
}
