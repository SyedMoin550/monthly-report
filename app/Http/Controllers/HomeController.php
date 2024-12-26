<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MonthlyReport;
use App\Imports\MonthlyReportImport;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    public function index()
    {
        $reportData = MonthlyReport::latest()->get();
        return view('index', compact('reportData'));
    }


    // public function import(Request $request)
    // {
    //     try {
    //         $request->validate([
    //             'file' => 'required|file|mimes:xlsx,xls,csv'
    //         ]);
    //         $import = new ClientsImport;
    //         Excel::import($import, $request->file('file')->store('files'));


    //         if ($import->newCustomersCount() == 0) {
    //             return redirect()->back()->with('error', 'No new customers were added may be  imported customers already exists');
    //         }

    //         // return redirect()->back()->with('success', $import->newCustomersCount() . ' new products added successfully');

    //         // Excel::import(new CustomersImport, $request->file('file'));

    //         return redirect()->route('customers.index')
    //             ->with('success', $import->newCustomersCount() . ' New Customers imported successfully.');
    //     } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
    //         $failures = $e->failures();

    //         $error = [];
    //         foreach ($failures as $failure) {
    //             $error[] = 'Row ' . $failure->row() . ' ' . $failure->errors()[0];
    //         }

    //         return redirect()->route('customers.index')
    //             ->with('error', implode('<br>', $error));
    //     } catch (QueryException $e) {
    //         // Check if it's a duplicate entry error
    //         if ($e->errorInfo[1] === 1062) {
    //             return redirect()->route('customers.index')
    //                 ->with('error', 'Duplicate entry. This product already exists.');
    //         } else {
    //             // Handle other database errors as needed
    //             return redirect()->route('customers.index')
    //                 ->with('error', 'An error occurred during import.');
    //         }
    //     }
    // }


    public function import(Request $request)
    {
        try {
            $request->validate([
                'file' => 'required|file|mimes:xlsx,xls,csv'
            ]);

            $import = new MonthlyReportImport; // Update to the correct Import class for MonthlyReport
            Excel::import($import, $request->file('file')->store('files'));

            if ($import->newReportsCount() == 0) {
                return redirect()->back()->with('error', 'No new reports were added. Imported reports may already exist.');
            }

            return redirect()->route('home')
                ->with('success', $import->newReportsCount() . ' new monthly reports imported successfully.');
        } catch (\Maatwebsite\Excel\Validators\ValidationException $e) {
            $failures = $e->failures();

            $error = [];
            foreach ($failures as $failure) {
                $error[] = 'Row ' . $failure->row() . ': ' . $failure->errors()[0];
            }

            return redirect()->route('home')
                ->with('error', implode('<br>', $error));
        } catch (\Illuminate\Database\QueryException $e) {
            // Check for duplicate entry error
            if ($e->errorInfo[1] === 1062) {
                return redirect()->route('home')
                    ->with('error', 'Duplicate entry. This report already exists.');
            } else {
                return redirect()->route('home')
                    ->with('error', 'An error occurred during import: ' . $e->getMessage());
            }
        } catch (\Exception $e) {
            return redirect()->route('home')
                ->with('error', 'An unexpected error occurred: ' . $e->getMessage());
        }
    }


    








}
