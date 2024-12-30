<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MonthlyReport extends Model
{
    protected $fillable = [
        'sr_number',
        'receiving_date',
        'truck',
        'driver',
        'manifest',
        'unit',
        'quantity',
        'minimum_weight',
        'maximum_weight',
        'average_weight',
        'time_in',
        'time_out',
        'waste_type',
        'location',
        'client',
        'dumping',
        'unit_price',
        'other_charges',
        'payment_status',
        'column1',
        'car_number',
        'type_of_materials',
        'contract_number',
        'properties_code',
        'transporter_ticket_number',
        'disp_ticket_number',
        'disposal_method',
        'treatment_method',
        'disposal_treatment',
        'date_load',
        'baverage_of_printer',

    ];
}
