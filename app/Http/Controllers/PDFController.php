<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class PDFController extends Controller
{
    public function generatePdf()
    {
        $data = [
            'title' => 'Report',
            'date' => date('M d, Y'),
            'reservation' => Reservation::all(),
        ];

        $pdf = Pdf::loadView('admin.pdf.report', $data);
        return $pdf->stream('report.pdf');
    }
}
