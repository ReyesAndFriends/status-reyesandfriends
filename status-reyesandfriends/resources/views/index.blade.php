@extends('layouts.app')

@section('content')
    <div class="w-full max-w-2xl mb-8">
        <div class="rounded-lg px-6 py-4 text-center text-lg font-medium shadow {{ $generalStatus['color'] }}">
            <span class="inline-flex items-center">
                @if ($generalStatus['icon'] === 'ticket')
                    <i class="fas fa-check-circle w-5 h-5 mr-2"></i>
                @elseif ($generalStatus['icon'] === 'alert-triangle')
                    <i class="fas fa-exclamation-triangle w-5 h-5 mr-2"></i>
                @elseif ($generalStatus['icon'] === 'alert-circle')
                    <i class="fas fa-exclamation-circle w-5 h-5 mr-2"></i>
                @elseif ($generalStatus['icon'] === 'activity')
                    <i class="fas fa-bolt w-5 h-5 mr-2"></i>
                @elseif ($generalStatus['icon'] === 'clock')
                    <i class="fas fa-clock w-5 h-5 mr-2"></i>
                @endif
                {{ $generalStatus['text'] }}
            </span>
        </div>
    </div>

    <div class="w-full max-w-6xl">
        <h2 class="text-xl font-semibold mb-4 dark:text-[#FDFDFC]">Estado de los servicios</h2>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white dark:bg-[#18181b]">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Servicio</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Tipo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Estado</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Uptime</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Última actualización</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $service->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $service->type->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($service->is_active)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $service->status->color ?? 'bg-gray-400' }} text-white">
                                    {{ $service->status->name }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-600 text-white">
                                    Deshabilitado
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if (is_null($service->uptime_percentage))
                                <span class="text-gray-500 dark:text-gray-300">N/A</span>
                            @else
                                {{ number_format($service->uptime_percentage, 2) }}%
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $service->updated_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">No hay servicios disponibles.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
