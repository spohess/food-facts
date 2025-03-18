<?php

use Illuminate\Support\Facades\Schedule;

Schedule::command('etl:import-producst')->dailyAt('01:00');
