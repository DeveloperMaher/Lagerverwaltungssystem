<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Materials;

class PdfController extends Controller
{
    
    public function generatePdf()
    {
        $materials = Materials::all();

        $rowCount = $materials->count();
        $now = now()->format('d.m.Y H:i');

        $pdf = Pdf::loadView('pdf.materials', [
            'materials' => $materials,
            'rowCount' => $rowCount,
            'now' => $now
            ])->setOptions([
            'isRemoteEnabled' => true,
            'isHtml5ParserEnabled' => true,
            'defaultFont' => 'DejaVu Sans'
        ]);

        // return $pdf->download('materialtabelle.pdf');

        // or:
        return $pdf->stream('materialtabelle.pdf');
    }
}
