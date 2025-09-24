<?php

namespace App\Imports;

use App\Models\MeterHistory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class MeterHistoriesImport implements ToModel, WithStartRow
{
    private $rowCount = 0;
    private $importedCount = 0;

    /**
     * Start reading from row 2 (skip header row)
     */
    public function startRow(): int
    {
        return 2;
    }

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Skip empty rows
        if (empty(array_filter($row))) {
            return null;
        }

        $this->rowCount++;

        // Map columns by position (index-based)
        // Adjust these indexes based on your actual Excel column positions
        $changedDate = null;
        if (!empty($row[5])) { // Changed Date is column F (index 5)
            try {
                if (is_numeric($row[5])) {
                    $changedDate = Date::excelToDateTimeObject($row[5])->format('Y-m-d');
                } else {
                    $changedDate = date('Y-m-d', strtotime($row[5]));
                    if ($changedDate === '1970-01-01') {
                        $changedDate = null;
                    }
                }
            } catch (\Exception $e) {
                $changedDate = null;
            }
        }

        $this->importedCount++;

        return new MeterHistory([
            // Map by column index - adjust these numbers based on your Excel file
            'status' => $row[0] ?? null, // Column A
            'reason' => $row[1] ?? null, // Column B
            'community' => $row[2] ?? null, // Column C
            'english_name' => $row[3] ?? null, // Column D
            'comet_id' => $this->convertToString($row[4] ?? null), // Column E
            'changed_date' => $changedDate, // Column F
            'meter_number' => $this->convertToString($row[6] ?? null), // Column G
            'household_status' => $row[7] ?? null, // Column H
            'old_community_new_holder' => $row[8] ?? null, // Column I
            'new_community_new_holder' => $row[9] ?? null, // Column J
            'new_holder_name' => $row[10] ?? null, // Column K
            'comet_id_new_holder' => $this->convertToString($row[11] ?? null), // Column L
            'old_meter_number_new_holder' => $this->convertToString($row[12] ?? null), // Column M
            'new_meter_number_new_holder' => $this->convertToString($row[13] ?? null), // Column N
            'status_new_holder' => $row[14] ?? null, // Column O
            'new_community_name' => $row[15] ?? null, // Column P
            'old_meter_number' => $this->convertToString($row[16] ?? null), // Column Q
            'new_meter_number' => $this->convertToString($row[17] ?? null), // Column R
            'main_holder' => $row[18] ?? null, // Column S
            'comet_id_main_holder' => $this->convertToString($row[19] ?? null), // Column T
            'meter_number_main_holder' => $this->convertToString($row[20] ?? null), // Column U
            'notes' => $row[21] ?? null, // Column V
        ]);
    }

    /**
     * Convert numeric values to string to preserve formatting
     */
    private function convertToString($value)
    {
        if (is_null($value) || $value === '') {
            return null;
        }

        if (is_numeric($value)) {
            return (string) $value;
        }

        return $value;
    }

    /**
     * Get the number of imported rows
     */
    public function getRowCount(): int
    {
        return $this->importedCount;
    }

    /**
     * Get total rows processed
     */
    public function getTotalRows(): int
    {
        return $this->rowCount;
    }
}