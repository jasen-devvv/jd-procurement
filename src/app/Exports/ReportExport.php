<?php

namespace App\Exports;

use App\Models\Report;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromArray, WithHeadings, WithStyles, ShouldAutoSize
{
    protected $report;
    protected $title;

    public function __construct($reportId, $title = "REPORT TITLE")
    {
        $this->report = Report::with(['product', 'supplier'])->findOrFail($reportId);
        $this->title = $title;
    }

    public function array(): array
    {
        $data = $this->report;
        $topSupplier = $data->top_supplier_id ? $data->supplier->name : 'empty';
        $topProduct = $data->top_product_id ? $data->product->name : 'empty';

            return [[
                $data->total_suppliers,
                $data->total_products,
                $data->total_orders,
                $topSupplier,
                $data->top_supplier_total,
                $topProduct,
                $data->top_product_total,
            ]];
    }

    public function headings(): array
    {
        return [
            [$this->title],
            [''],
            ['Name: ' . $this->report->name, '', '', '', '', '', 'Created At: ' . $this->report->created_at->format('l, d/m/Y')],
            ['Total Suppliers', 'Total Products', 'Total Orders', 'Top Supplier', 'Total Top Supplier', 'Top Product', 'Total Top Product'],
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:G1');
        $sheet->mergeCells('A2:G2');
        $sheet->mergeCells('B2:F2');

        $sheet->getStyle('A1')->getAlignment()->setHorizontal('center');
        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(14);
        $sheet->getStyle('A3:G3')->applyFromArray([
            'font' => [
                'bold' => true
            ],
        ]);
        $sheet->getStyle('A4:G4')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '4CAF50']
            ],
        ]);
        $sheet->getStyle('A5:G5')->getAlignment()->setHorizontal('left');
    }
}
