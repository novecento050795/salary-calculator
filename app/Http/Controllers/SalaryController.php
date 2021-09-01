<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\SalaryService;
use App\Models\Salary;

class SalaryController extends Controller
{

    private $salary_service;

    public function __construct(SalaryService $salary_service) {
        $this->salary_service = $salary_service;
    }

    public function calculate(Request $request) {

        $data = $request->validate([
            'salary' => 'required|int',
            'days_norm' => 'required|int',
            'worked_days' => 'required|int',
            'is_tax_deduction' => 'required|bool',
            'calendar_year' => 'required|int|max:'.now()->year,
            'calendar_month' => 'required|int|between:1,12',
            'is_pensioner' => 'required|bool',
            'is_disabled' => 'required|bool',
            'disabled_group' => 'required_if:is_disabled,1|int|between:1,3'
        ]);

        return $this->salary_service->calculate($data);
    }

    public function store(Request $request) {
        
        $data = $request->validate([
            'salary' => 'required|int',
            'days_norm' => 'required|int',
            'worked_days' => 'required|int',
            'is_tax_deduction' => 'required|bool',
            'calendar_year' => 'required|int|max:'.now()->year,
            'calendar_month' => 'required|int|between:1,12',
            'is_pensioner' => 'required|bool',
            'is_disabled' => 'required|bool',
            'disabled_group' => 'required_if:is_disabled,1|int|between:1,3'
        ]);

        $calculated_data = $this->salary_service->calculate($data);
        
        if (!$data['is_disabled'] && isset($data['disabled_group']))
            unset($data['disabled_group']);

        Salary::create(array_merge($data, $calculated_data));
        
        return $calculated_data;
    }
}
