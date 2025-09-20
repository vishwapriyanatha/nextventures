<?php

namespace App\Http\Controllers\API;

use App\Contracts\Services\KpiServiceInterface;
use App\Core\BaseController;

class KpiController extends BaseController
{
    protected $kpiService;

    public function __construct(
        KpiServiceInterface $kpiService
    )
    {
        $this->kpiService = $kpiService;
    }

    public function getDailyKPI()
    {
        return $this->kpiService->getDailyKPIs();
    }

}
