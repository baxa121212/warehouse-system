<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>WarehouseSys</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans antialiased bg-slate-50 text-slate-900">
<div class="min-h-screen flex flex-col">
    @include('layouts.navigation')

    @isset($header)
        <header class="bg-slate-50">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                {{ $header }}
            </div>
        </header>
    @endisset

    <main class="flex-1">
        {{ $slot }}
    </main>

    @php
        $lang = request('lang', 'kk');
        $footerTitle = $lang == 'ru' ? 'Складская система' : ($lang == 'en' ? 'Warehouse System' : 'Қойма жүйесі');
        $footerText = $lang == 'ru'
            ? 'Современное веб-приложение для учета товаров, категорий и складских остатков.'
            : ($lang == 'en'
                ? 'A modern web application for managing products, categories, and warehouse stock.'
                : 'Тауарларды, категорияларды және қойма қалдықтарын басқаруға арналған заманауи веб-қосымша.');
        $footerNav1 = $lang == 'ru' ? 'Навигация' : ($lang == 'en' ? 'Navigation' : 'Навигация');
        $footerNav2 = $lang == 'ru' ? 'Полезно' : ($lang == 'en' ? 'Useful' : 'Пайдалы');
        $dashboardText = $lang == 'ru' ? 'Панель управления' : ($lang == 'en' ? 'Dashboard' : 'Басқару панелі');
        $productsText = $lang == 'ru' ? 'Товары' : ($lang == 'en' ? 'Products' : 'Тауарлар');
        $categoriesText = $lang == 'ru' ? 'Категории' : ($lang == 'en' ? 'Categories' : 'Категориялар');
        $courseText = $lang == 'ru' ? 'Курсовой проект' : ($lang == 'en' ? 'Course Project' : 'Курстық жоба');
        $yearText = $lang == 'ru' ? 'Все права защищены.' : ($lang == 'en' ? 'All rights reserved.' : 'Барлық құқықтар қорғалған.');
    @endphp

    <footer class="bg-slate-950 text-white mt-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
                <div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="w-11 h-11 rounded-2xl bg-white text-slate-900 flex items-center justify-center font-bold shadow">
                            W
                        </div>
                        <div>
                            <h3 class="text-lg font-bold">{{ $footerTitle }}</h3>
                            <p class="text-sm text-slate-400">WarehouseSys</p>
                        </div>
                    </div>
                    <p class="text-slate-300 leading-7 max-w-md">
                        {{ $footerText }}
                    </p>
                </div>

                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-400 mb-4">
                        {{ $footerNav1 }}
                    </h4>
                    <div class="space-y-3">
                        <a href="{{ route('dashboard', ['lang' => $lang]) }}" class="block text-slate-300 hover:text-white transition">
                            {{ $dashboardText }}
                        </a>
                        <a href="{{ route('products.index', ['lang' => $lang]) }}" class="block text-slate-300 hover:text-white transition">
                            {{ $productsText }}
                        </a>
                        <a href="{{ route('categories.index', ['lang' => $lang]) }}" class="block text-slate-300 hover:text-white transition">
                            {{ $categoriesText }}
                        </a>
                    </div>
                </div>

                <div>
                    <h4 class="text-sm font-semibold uppercase tracking-wider text-slate-400 mb-4">
                        {{ $footerNav2 }}
                    </h4>
                    <div class="space-y-3 text-slate-300">
                        <p>{{ $courseText }}</p>
                        <p>Laravel + Blade + Tailwind</p>
                        <p>2026</p>
                    </div>
                </div>
            </div>

            <div class="border-t border-slate-800 mt-10 pt-6 flex flex-col md:flex-row md:items-center md:justify-between gap-3">
                <p class="text-sm text-slate-400">
                    © {{ date('Y') }} WarehouseSys. {{ $yearText }}
                </p>
                <p class="text-sm text-slate-500">
                    Built for academic presentation
                </p>
            </div>
        </div>
    </footer>
</div>
</body>
</html>
