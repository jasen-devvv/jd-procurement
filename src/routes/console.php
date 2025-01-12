<?php

use App\Console\Commands\GenerateMonthlyReport;
use Illuminate\Support\Facades\Schedule;

Schedule::command('report:generate')->lastDayOfMonth('23:50');
