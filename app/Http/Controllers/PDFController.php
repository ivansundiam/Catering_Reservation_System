<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
class PDFController extends Controller
{
    public function reportPdf(Request $request)
    {
        $reportDetails = json_decode($request->input('reportDetails'), true);
        $reservationIds = collect($reportDetails['reservations'])->pluck('id');

        $reservations = Reservation::whereIn('id', $reservationIds)->get();

        $date = date('M d, Y');
        $reportType = '';
        $dateType = $reportDetails['date'];
    
        switch ($dateType) {
            case 'weekly':
                $reportType = strtoupper($date) . '_WEEKLY_REPORT';
                break;
            case 'monthly':
                $monthName = strtoupper(date('F', mktime(0, 0, 0, $reportDetails['month'], 1)));
                $reportType = $reportDetails['year'] . '-' . $monthName . '_MONTHLY_REPORT';
                break;
            case 'annually':
                $reportType = $reportDetails['year'] . '_ANNUAL_REPORT';
                break;
            default:
                $reportType = 'REPORT';
        }

        $data = [
            'title' => $reportType,
            'date' => date('M d, Y'),
            'reportDetails' => $reportDetails,
            'reservations' => $reservations,
        ];
    

        $pdf = Pdf::loadView('admin.pdf.report', $data);
        return $pdf->stream($reportType . '.pdf');
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
