<?php

namespace App\Imports;

use App\Models\MeterHistory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MeterHistoriesImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // Skip row if all fields are empty
        if (array_filter($row) === []) {
            return null; // Ignore empty row
        }

        return new MeterHistory([
            'status' => $row['status'] ?? null,
            'reason' => $row['reason'] ?? null,
            'community' => $row['community'] ?? null,
            'english_name' => $row['english_name'] ?? null,
            'comet_id' => $row['comet_id_(household,_public)'] ?? null,
            'changed_date' => isset($row['changed_date']) ? date('Y-m-d', strtotime($row['changed_date'])) : null,
            'meter_number' => $row['meter_number'] ?? null,
            'household_status' => $row['household_status'] ?? null,
            'old_community_new_holder' => $row['old_community_for_new_holder'] ?? null,
            'new_community_new_holder' => $row['new_community_for_new_holder'] ?? null,
            'new_holder_name' => $row['new_holder_name_(household/public)'] ?? null,
            'comet_id_new_holder' => $row['comet_id_for_the_new_household/public'] ?? null,
            'old_meter_number_new_holder' => $row['old_meter_number_for_the_new_holder'] ?? null,
            'new_meter_number_new_holder' => $row['new_meter_number_for_the_new_holder'] ?? null,
            'status_new_holder' => $row['status_for_the_new_holder'] ?? null,
            'new_community_name' => $row['new_community_name'] ?? null,
            'old_meter_number' => $row['old_meter_number'] ?? null,
            'new_meter_number' => $row['new_meter_number'] ?? null,
            'main_holder' => $row['main_holder'] ?? null,
            'comet_id_main_holder' => $row['comet_id_for_the_main_holder'] ?? null,
            'meter_number_main_holder' => $row['meter_number_1'] ?? null,
            'notes' => $row['notes'] ?? null,
        ]);
    }
}
