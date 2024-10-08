<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function pdfReport() {
        return view('reports.pdf');
    }

    public function excelReport() {
        return view('reports.excel');
    }
}
