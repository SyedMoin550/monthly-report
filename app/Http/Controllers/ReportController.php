<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use App\Models\MonthlyReport;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
        return redirect()->route('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('reports.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'receiving_date' => 'required|date',
            'truck' => 'nullable|string',
            'driver' => 'required|string',
            'manifest' => 'nullable|string',
            'unit' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'minimum_weight' => 'nullable|numeric',
            'maximum_weight' => 'nullable|numeric',
            'time_in' => 'nullable|string',
            'time_out' => 'nullable|string',
            'waste_type' => 'nullable|string',
            'location' => 'nullable|string',
            'client' => 'nullable|string',
            'dumping' => 'nullable|string',
            'unit_price' => 'nullable|string',
            'other_charges' => 'nullable|numeric',
            'payment_status' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['average_weight'] = $data['maximum_weight'] - $data['minimum_weight'];

        MonthlyReport::create($data);

        return redirect()->route('reports.index')->with('success', 'Monthly Report added successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $record = MonthlyReport::findOrFail($id);
        return view('reports.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'receiving_date' => 'required|date',
            'truck' => 'nullable|string',
            'driver' => 'required|string',
            'manifest' => 'nullable|string',
            'unit' => 'nullable|string',
            'quantity' => 'nullable|integer',
            'minimum_weight' => 'nullable|numeric',
            'maximum_weight' => 'nullable|numeric',
            'time_in' => 'nullable|string',
            'time_out' => 'nullable|string',
            'waste_type' => 'nullable|string',
            'location' => 'nullable|string',
            'client' => 'nullable|string',
            'dumping' => 'nullable|string',
            'unit_price' => 'nullable|string',
            'other_charges' => 'nullable|numeric',
            'payment_status' => 'nullable|string',
        ]);

        $data = $request->all();
        $data['average_weight'] = $data['maximum_weight'] - $data['minimum_weight'];
        $report = MonthlyReport::findOrFail($id);
        $report->update($data);
        return redirect()->route('reports.index')->with('success', 'Monthly Report updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $report = MonthlyReport::findOrFail($id);
        $report->delete();
        return redirect()->route('reports.index')->with('success', 'Monthly Report deleted successfully.');
    }




    // public function downloadPdf($id)
    // {
    //     // $sale = Sale::find($id);
    //     // $sale->load('productItems', 'customer', 'warehouse', 'invoice');

    //     // $totalDue = $sale->customer->sales->sum('amount_due');
    //     // $logo = getLogo();
    //     // $pdf = Pdf::loadView('back.sales.invoice', ['sale' => $sale, 'logo' => $logo, 'totalDue' => $totalDue]);

    //     // return $pdf->download($sale->invoice->invoice_id . '.pdf');

    //     $report = MonthlyReport::findOrFail($id);
    //     $pdf = PDF::loadView('reports.pdf', compact('report'));
    //     // return $pdf->download('monthly-report-' . $report->sr_number . '.pdf');


    //     // Ensure the directory exists
    //     $directoryPath = storage_path('app/public/invoices');
    //     if (!file_exists($directoryPath)) {
    //         mkdir($directoryPath, 0755, true);
    //     }

    //     // Save the PDF
    //     $path = $directoryPath . '/invoice-' . $report->id . '.pdf';
    //     $pdf->save($path);

    //     // Send the PDF to the printer
    //     $printerName = "your_printer_name"; // Replace with actual printer name
    //     $command = "lp -d " . escapeshellarg($printerName) . " " . escapeshellarg($path);

    //     try {
    //         exec($command, $output, $status);
    //         if ($status === 0) {
    //             return response()->json(['message' => 'Invoice printed successfully.']);
    //         }
    //         else {
    //             return response()->json(['error' => 'Failed to print. Check printer configuration.'], 500);
    //         }
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }



    // }

    // public function downloadPdf($id)
    // {
    //     $report = MonthlyReport::findOrFail($id);
    //     $pdf = PDF::loadView('reports.pdf2', compact('report'));

    //     // Ensure directory exists
    //     $directoryPath = storage_path('app/public/invoices');
    //     if (!file_exists($directoryPath)) {
    //         mkdir($directoryPath, 0755, true);
    //     }

    //     // Save the PDF
    //     $path = $directoryPath . '/invoice-'. rand(1111,9999) . $report->id . '.pdf';
    //     $pdf->save($path);

    //     // Printer setup
    //     $printerName = "EPSON_LQ_350";
    //     // for linux use this command
    //     $command = "lp -d " . escapeshellarg($printerName) . " " . escapeshellarg($path);
    //     // for window use this command
    //     // $command = "print /d:" . escapeshellarg("\\\\" . gethostname() . "\\" . $printerName) . " " . escapeshellarg($path);


    //     // Execute print command
    //     try {
    //         exec($command, $output, $status);
    //         // exec("lp $path");
    //         // return redirect()->route('home')->with('success', 'Monthly Report printed successfully.');
    //         if ($status === 0) {
    //             return redirect()->route('home')->with('success', 'Monthly Report printed successfully.');
    //         } else {
    //             return redirect()->route('home')->with('error', 'Failed to print. Check printer configuration.');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->route('home')->with('error', 'An error occurred while printing: ' . $e->getMessage());
    //     }
    // }


    // public function downloadPdf($id)
    // {
    //     // Retrieve the report
    //     $report = MonthlyReport::findOrFail($id);

    //     // Generate the PDF from the Blade view
    //     $pdf = PDF::loadView('reports.pdf2', compact('report'));

    //     // Ensure the directory exists
    //     $directoryPath = storage_path('app/public/invoices');
    //     if (!file_exists($directoryPath)) {
    //         mkdir($directoryPath, 0755, true);
    //     }

    //     // Save the PDF to the directory
    //     $fileName = 'invoice-' . rand(1111, 9999) . '-' . $report->id . '.pdf';
    //     $filePath = $directoryPath . '/' . $fileName;
    //     $pdf->save($filePath);

    //     // Printer setup
    //     $printerName = "EPSON_LQ_350";

    //     // Determine the OS and set the correct command
    //     if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
    //         // Command for Windows
    //         $command = "print /d:" . escapeshellarg("\\\\" . gethostname() . "\\" . $printerName) . " " . escapeshellarg($filePath);
    //     } else {
    //         // Command for Linux/macOS
    //         $command = "lp -d " . escapeshellarg($printerName) . " " . escapeshellarg($filePath);
    //     }

    //     // Execute the print command
    //     try {
    //         exec($command, $output, $status);

    //         if ($status === 0) {
    //             return redirect()->route('home')->with('success', 'Monthly Report printed successfully.');
    //         } else {
    //             return redirect()->route('home')->with('error', 'Failed to print. Check printer configuration.');
    //         }
    //     } catch (\Exception $e) {
    //         return redirect()->route('home')->with('error', 'An error occurred while printing: ' . $e->getMessage());
    //     }
    // }


    public function downloadPdf($id)
    {
        // Retrieve the report
        $report = MonthlyReport::findOrFail($id);

        // Generate the PDF from the Blade view
        return view('reports.pdf2', compact('report'));
    }


    public function printPdf($id)
    {
        // Fetch the record from the database
        $report = MonthlyReport::findOrFail($id);

        if (!$report) {
            return redirect()->back()->with('error', 'Data not found!');
        }

        // Generate PDF
        $pdf = Pdf::loadView('reports.pdf2', compact('report'));

        // Return the PDF for download or display
        return $pdf->stream('report.pdf');
    }
}
