<?php

namespace App\Contracts\Services;

interface KpiServiceInterface
{
    public function generateDailyKPIs();

    public function getDailyKPIs($date = null);
}
