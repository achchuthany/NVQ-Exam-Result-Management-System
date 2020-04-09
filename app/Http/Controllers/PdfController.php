<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PDF;
class PdfController extends Controller
{
    public function generatePDF()

    {
        $data = ['title' => 'Welcome to ItSolutionStuff.com'];

        $pdf = PDF::loadView('pdf', $data)->setPaper('a4', 'landscape');
        return $pdf->download('itsolutionstuff.pdf');

    }
}
