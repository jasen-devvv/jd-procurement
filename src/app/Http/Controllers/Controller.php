<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // Calculate Percentage
    protected function calculatePercentageChange($current, $previous)
    {
        if ($previous == 0) {
            return $current > 0 ? 100 : 0 ; 
        }

        return (($current - $previous) / $previous) * 100;
    }
}
