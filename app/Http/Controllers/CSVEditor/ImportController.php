<?php

declare(strict_types=1);

namespace App\Http\Controllers\CSVEditor;

use App\CSVHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class ImportController extends Controller
{
    /**
     * Import the CSV file and return the data as an array
     *
     * @param Request $request
     * @param CSVHandler $csv_handler
     *
     * @return JsonResponse
     */
    public function import(Request $request, CSVHandler $csv_handler): JsonResponse
    {
        $data = $csv_handler->parse_csv_file($request->file('csv_file'));

        return response()->json($data);
    }
}
