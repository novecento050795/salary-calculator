<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Salary extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary',
        'days_norm',
        'worked_days',
        'is_tax_deduction',
        'calendar_year',
        'calendar_month',
        'is_pensioner',
        'is_disabled',
        'disabled_group',
        'osms_tax',
        'vosms_tax',
        'opv_tax',
        'ipn_tax',
        'so_tax',
        'hand_salary',
        'credited_salary'
    ];
    
}
