<?php

declare(strict_types=1);

namespace App\Http\Controllers\CSVEditor;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class EditorController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('csv-editor');
    }
}
