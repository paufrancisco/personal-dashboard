<script setup>
import { Link } from '@inertiajs/vue3';
import ApplicationLogo from '@/Components/ApplicationLogo.vue';

</script>

<template>
    <div class="flex h-screen bg-gray-100 dark:bg-gray-900">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white dark:bg-gray-800 shadow-md flex flex-col">

            <!-- Logo -->
            <div class="flex items-center justify-center h-16 border-b border-gray-200 dark:border-gray-700">
                <Link :href="route('dashboard')">
                    <ApplicationLogo class="h-9 w-auto fill-current text-gray-800 dark:text-gray-200" />
                </Link>
                <span class="ml-3 font-bold text-gray-800 dark:text-gray-200 text-lg">My Dashboard</span>
            </div>

            <!-- Nav Links -->
            <nav class="flex-1 px-4 py-6 space-y-2">

                <Link
                    :href="route('dashboard')"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                    :class="{ 'bg-indigo-50 text-indigo-600 font-semibold dark:bg-gray-700': route().current('dashboard') }"
                >
                    🏠 Home
                </Link>

                <Link
                    :href="route('shortcuts.page')"
                    class="flex items-center gap-3 px-4 py-2 rounded-lg text-gray-600 dark:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700 transition"
                    :class="{ 'bg-indigo-50 text-indigo-600 font-semibold dark:bg-gray-700': route().current('shortcuts.page') }"
                >
                    ⌨️ Command Shortcuts
                </Link>

            </nav>

            <!-- User + Logout -->
            <div class="border-t border-gray-200 dark:border-gray-700 px-4 py-4">
                <p class="text-sm font-medium text-gray-800 dark:text-gray-200">{{ $page.props.auth.user.name }}</p>
                <p class="text-xs text-gray-500 dark:text-gray-400">{{ $page.props.auth.user.email }}</p>
                <Link
                    :href="route('logout')"
                    method="post"
                    as="button"
                    class="mt-3 text-sm text-red-500 hover:text-red-700 transition"
                >
                    Log Out
                </Link>
            </div>

        </aside>

        <!-- MAIN CONTENT -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Top Bar -->
            <header class="h-16 bg-white dark:bg-gray-800 shadow flex items-center px-6">
                <h1 class="text-lg font-semibold text-gray-700 dark:text-gray-200">
                    <slot name="header" />
                </h1>
            </header>

            <!-- Page Content -->
            <main class="flex-1 overflow-y-auto p-6">
                <slot />
            </main>

        </div>
    </div>
</template>