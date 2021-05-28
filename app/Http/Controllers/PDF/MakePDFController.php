<?php

namespace App\Http\Controllers\PDF;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App;

class MakePDFController extends Controller
{
    function gerar()
    {
        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML(view('PDF.pdfmaker'));

        return view('site.pdf.pdfmaker');

        // return $pdf->stream();

    }
}
