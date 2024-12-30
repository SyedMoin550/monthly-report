<?php

namespace App\Imports;

use App\Models\MonthlyReport;
use Maatwebsite\Excel\Concerns\ToModel;
use PhpOffice\PhpSpreadsheet\Shared\Date;
use Maatwebsite\Excel\Concerns\WithStartRow;

class MonthlyReportImport implements ToModel, WithStartRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */

    private $newReportsCount = 0;

    public function model(array $row)
    {
        // Skip rows with missing required data
        $indexes = [1, 2, 3, 4]; // Required indexes (e.g., Receiving Date, Truck, Driver, Manifest)
        foreach ($indexes as $index) {
            if (!isset($row[$index]) || empty($row[$index])) {
                return null;
            }
        }

        $averageWeight = $row[8] - $row[7];
        // $timeIn = Date::excelToDateTimeObject($row[10])->format('H:i:s'); // Assuming $row[8] is time_in
        // $timeOut = Date::excelToDateTimeObject($row[11])->format('H:i:s');

        if(isset($row[10]) && !empty($row[10])) {
            $timeIn = Date::excelToDateTimeObject($row[10])->format('H:i:s');
        } else {
            $timeIn = null;
        }

        if(isset($row[11]) && !empty($row[11])) {
            $timeOut = Date::excelToDateTimeObject($row[11])->format('H:i:s');
        } else {
            $timeOut = null;
        }



        // dd( \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[0]);

        // $data =  \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]);
        // dd($row);

        $report = new MonthlyReport([
            'sr_number' => $row[0] ?? null,
            // 'receiving_date' => $row[1],
            'receiving_date'     => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row[1]),
            'truck' => $row[2],
            'driver' => $row[3],
            'manifest' => $row[4],
            'unit' => $row[5] ?? null,
            'quantity' => $row[6] ?? null,
            'minimum_weight' => $row[7] ?? null,
            'maximum_weight' => $row[8] ?? null,
            'average_weight' => $averageWeight ?? null,
            'time_in' => $timeIn ?? null,
            'time_out' => $timeOut ?? null,
            'waste_type' => $row[13] ?? null,
            'location' => $row[14] ?? null,
            'client' => $row[15] ?? null,
            'dumping' => $row[16] ?? null,
            'unit_price' => $row[17] ?? null,
            'other_charges' => $row[18] ?? null,
            'payment_status' => $row[19] ?? null,
            'column1' => $row[20] ?? null,
            'baverage_of_printer' => $row[21] ?? null,
        ]);

        $report->save();
        $this->newReportsCount++;

        return $report;
    }

    public function newReportsCount()
    {
        return $this->newReportsCount;
    }

    public function startRow(): int
    {
        return 3; // Skip the header row
    }
}
