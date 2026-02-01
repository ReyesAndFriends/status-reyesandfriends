@extends('layouts.app')

@section('content')
    <div class="w-full max-w-2xl mb-8">
        <div class="rounded-lg bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-6 py-4 text-center text-lg font-medium shadow">
            <span class="inline-flex items-center">
                <svg class="w-5 h-5 mr-2 text-green-500" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
                </svg>
                All systems operating
            </span>
        </div>
    </div>

    <div class="w-full max-w-4xl">
        <h2 class="text-xl font-semibold mb-4 dark:text-[#FDFDFC]">Service Status</h2>
        <div class="overflow-x-auto rounded-lg shadow">
            <table class="min-w-full bg-white dark:bg-[#18181b]">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Service</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Type</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 dark:text-gray-300 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">Main Website</td>
                        <td class="px-6 py-4 whitespace-nowrap">Website</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                Operational
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">Public API</td>
                        <td class="px-6 py-4 whitespace-nowrap">API</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                Operational
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">Authentication Service</td>
                        <td class="px-6 py-4 whitespace-nowrap">Service</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-yellow-100 dark:bg-yellow-900 text-yellow-800 dark:text-yellow-200">
                                Slow
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">Database</td>
                        <td class="px-6 py-4 whitespace-nowrap">Service</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200">
                                Operational
                            </span>
                        </td>
                    </tr>
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap font-medium">Admin Panel</td>
                        <td class="px-6 py-4 whitespace-nowrap">Website</td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 dark:bg-red-900 text-red-800 dark:text-red-200">
                                Down
                            </span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
@endsection
