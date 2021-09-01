<?php

namespace App\Services;

class SalaryService
{

  const MZP = 42500;
  const MRP = 2917;

  public function calculate($data) {

    $return_data = [
      'osms_tax' => 0,
      'vosms_tax' => 0,
      'opv_tax' => 0,
      'ipn_tax' => 0,
      'so_tax' => 0,
    ];

    $return_data['credited_salary'] = $data['salary'] * $data['worked_days'] / $data['days_norm'];

    if (!$data['is_pensioner'] && !$data['is_disabled']) {
      $return_data['osms_tax'] = $return_data['vosms_tax'] = $return_data['credited_salary'] * 0.02;
    }

    if (
      !($data['is_disabled'] && in_array($data['disabled_group'], [1, 2])) 
      && !$data['is_pensioner'] 
    ) {
      $return_data['opv_tax'] = $return_data['credited_salary'] * 0.1;
    }

    if (!$data['is_pensioner']) {
      $return_data['so_tax'] = (
        $return_data['credited_salary'] - $return_data['opv_tax']
      ) * 0.035;
    }

    $corrector = $return_data['credited_salary'] < self::MRP * 25
      ? (
        $return_data['credited_salary']
          - $return_data['opv_tax']
          - ($data['is_tax_deduction'] ? self::MZP : 0)
          - $return_data['vosms_tax']
      ) * 0.9
      : 0;

    if (
      !($data['is_disabled'] && $return_data['credited_salary'] <= self::MRP * 882)
      && !($data['is_pensioner'] && $data['is_disabled'])
    ) {
      $return_data['ipn_tax'] = (
        $return_data['credited_salary'] 
          - $return_data['opv_tax'] 
          - ($data['is_tax_deduction'] ? self::MZP : 0)
          - $return_data['vosms_tax']
          - $corrector
      ) * 0.1;
    }
   
    $return_data['hand_salary'] = $return_data['credited_salary']
      - $return_data['osms_tax']
      - $return_data['vosms_tax']
      - $return_data['opv_tax']
      - $return_data['so_tax']
      - $return_data['ipn_tax'];

    return $return_data;
    
  }
}