<?php

declare(strict_types=1);

namespace App\Http\Controllers\CSVEditor;

use App\CSVHandler;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;

class ExportController extends Controller {

    /**
     * Converts the user input into a CSV file and streams the file back to the user
     */
    public function convert(Request $request, CSVHandler $csv_handler): StreamedResponse
    {
        $request->validate([
            'columns' => 'required|array',
            'rows'    => 'required|array',
        ]);

        return $csv_handler->generate($request->input('rows'), $request->input('columns'));
    }
}
