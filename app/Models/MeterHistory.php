<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MeterHistory extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'reason',
        'community',
        'english_name',
        'comet_id',
        'changed_date',
        'meter_number',
        'household_status',
        'old_community_new_holder',
        'new_community_new_holder',
        'new_holder_name',
        'comet_id_new_holder',
        'old_meter_number_new_holder',
        'new_meter_number_new_holder',
        'status_new_holder',
        'new_community_name',
        'old_meter_number',
        'new_meter_number',
        'main_holder',
        'comet_id_main_holder',
        'meter_number_main_holder',
        'notes',
    ];
}
