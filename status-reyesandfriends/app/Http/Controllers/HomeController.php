<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class HomeController extends Controller
{
    public function index()
    {
        $services = Service::with(['status', 'type'])
            ->withCount('checks')
            ->withCount([
                'checks as successful_checks_count' => function ($query) {
                    $query->whereBetween('http_code', [200, 399]);
                },
            ])
            ->get()
            ->map(function ($service) {
                $service->uptime_percentage = $service->checks_count > 0
                    ? round(($service->successful_checks_count / $service->checks_count) * 100, 2)
                    : null;

                return $service;
            });

        $activeServices = $services->where('is_active', true);

        // Contar servicios por status (solo activos)
        $statusCounts = [
            'Operativo' => 0,
            'Degradado' => 0,
            'Interrupción parcial' => 0,
            'Interrupción mayor' => 0,
            'Mantenimiento programado' => 0,
        ];

        foreach ($activeServices as $service) {
            $statusName = $service->status->name ?? null;
            if (isset($statusCounts[$statusName])) {
                $statusCounts[$statusName]++;
            }
        }

        // Determinar el estado general
        $generalStatus = [
            'text' => 'Todos los sistemas operativos',
            'icon' => 'ticket',
            'color' => 'bg-green-500 text-white dark:bg-green-700',
        ];

        if ($statusCounts['Interrupción mayor'] > 0) {
            $generalStatus = [
                'text' => 'Interrupción mayor',
                'icon' => 'alert-triangle',
                'color' => 'bg-red-500 text-white dark:bg-red-700',
            ];
        } elseif ($statusCounts['Interrupción parcial'] > 0) {
            $generalStatus = [
                'text' => 'Interrupciones parciales',
                'icon' => 'alert-circle',
                'color' => 'bg-orange-500 text-white dark:bg-orange-700',
            ];
        } elseif ($statusCounts['Degradado'] > 0) {
            $generalStatus = [
                'text' => 'Algunos sistemas degradados',
                'icon' => 'activity',
                'color' => 'bg-yellow-500 text-white dark:bg-yellow-700',
            ];
        } elseif ($statusCounts['Mantenimiento programado'] === $activeServices->count() && $activeServices->count() > 0) {
            $generalStatus = [
                'text' => 'Mantenimiento programado',
                'icon' => 'clock',
                'color' => 'bg-blue-500 text-white dark:bg-blue-700',
            ];
        }

        return view('index', compact('services', 'generalStatus'));
    }
}
