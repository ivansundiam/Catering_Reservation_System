<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Dompdf\FontMetrics;
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

    public function receiptPdf()
    {
        $data = [
            'title' => 'Reservation Receipt',
            'date' => date('M d, Y'),
            'reservation' => Reservation::with('package', 'menu')->findOrFail(1),
        ];

        $pdf = Pdf::loadView('admin.pdf.receipt-pdf', $data);
        return $pdf->stream('receipt.pdf');
    }
}
