<?php

namespace App\Filters\Appointment;
use App\Filters\AbstractFilter;

class AppointmentIndexFilter extends AbstractFilter{
    protected $filters = [
        'type'=>SpecialityFilter::class,
        'date'=>DateFilter::class,
    ];
}
