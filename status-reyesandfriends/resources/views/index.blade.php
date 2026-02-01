@extends('layouts.app')

@section('content')
    <div class="w-full max-w-2xl mb-8">
        <div class="rounded-lg bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-6 py-4 text-center text-lg font-medium shadow">
            <span class="inline-flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                Todos los sistemas operativos
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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Última actualización</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($services as $service)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">{{ $service->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $service->type->name }}</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if ($service->status)
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold {{ $service->status->color ?? 'bg-gray-400' }} text-white">
                                    {{ $service->status->name }}
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-600 text-white">
                                    Deshabilitado
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">{{ $service->updated_at }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="px-6 py-4 text-center text-gray-500 dark:text-gray-300">No hay servicios disponibles.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
