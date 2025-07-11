<?php
namespace App\Services;

use App\Models\User;
use App\Models\Client;
use App\Models\Plugin;

class DashboardService
{
    /**
     * Return basic counts used for dashboard KPIs.
     */
    public function getCounts(): array
    {
        return [
            'users' => User::count(),
            'clients' => Client::count(),
            'plugins' => Plugin::count(),
        ];
    }
}
