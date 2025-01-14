<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ReportExport;
use Carbon\Carbon;

class ReportController extends Controller
{
    /**
     * Display a listing of the report.
     */
    public function index()
    {
        $reports = Report::all();

        $data = [
            'title' => 'Report | E-Procurement',
            'reports' => $reports
        ];

        return view('dashboard.report.index', $data);
    }

    /**
     * Display the specified report.
     */
    public function detail(string $id)
    {
        $report = Report::with(['product', 'supplier'])->findOrFail($id);

        $data = [
            'title' => 'Report | E-Procurement',
            'report' => $report
        ];

        return view('dashboard.report.detail', $data);
    }
    
    /**
     * Print to PDF the specified report.
     */
    public function pdf(string $id)
    {
        $report = Report::with(['supplier', 'product'])->findOrFail($id);

        $data = [
            'title' => 'Print Report | E-Procurement',
            'report' => $report
        ];

        $pdf = Pdf::loadView('dashboard.report.print', $data);
        return $pdf->download('report.pdf');

        return view('dashboard.report.print', $data);
    }

    /**
     * Print to EXCEL .xlsx the specified report.
     */
    public function excel(string $id)
    {
        $year = Carbon::now()->year;
        $title = "Report Monthly " . $year;
        return Excel::download(new ReportExport($id, $title), 'report.xlsx');
    }
}
