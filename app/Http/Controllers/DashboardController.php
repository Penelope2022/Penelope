<?php
namespace App\Http\Controllers;

use App\Services\DashboardService;

class DashboardController extends Controller
{
    private DashboardService $dashboard;

    public function __construct(DashboardService $dashboard)
    {
        $this->dashboard = $dashboard;
    }

    /**
     * Display dashboard with KPIs.
     */
    public function index()
    {
        $counts = $this->dashboard->getCounts();
        return view('dashboard', compact('counts'));
    }
}
