<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\CSVGenerator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Symfony\Component\HttpFoundation\StreamedResponse;

class CSVExportController extends Controller {
    /**
     * Converts the user input into a CSV file and streams the file back to the user
     */
    public function convert(Request $request, CSVGenerator $csv_generator): StreamedResponse
    {
        $request->validate([
            'columns' => 'required|array',
            'rows'    => 'required|array',
        ]);

        return $csv_generator->generate($request->input('rows'), $request->input('columns'));
    }
}
