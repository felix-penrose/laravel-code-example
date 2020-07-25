<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CSVEditorController extends Controller
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
