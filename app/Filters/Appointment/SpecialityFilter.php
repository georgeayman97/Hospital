<?php

namespace App\Filters\Appointment;
use App\Filters\AbstractBasicFilter;

class SpecialityFilter extends AbstractBasicFilter{
    public function filter($value)
    {
        return $this->builder->Where('speciality_id',$value);
    }
}
