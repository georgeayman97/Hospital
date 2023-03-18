<?php

namespace App\Filters\Appointment;
use App\Filters\AbstractBasicFilter;

class DateFilter extends AbstractBasicFilter{
    public function filter($value)
    {
        return $this->builder->whereDate('date_time',$value);
    }
}
