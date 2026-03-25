<x-app-layout>
    @php
        $lang = request('lang', 'kk');

        $dashboard = $lang == 'ru' ? 'Панель управления' : ($lang == 'en' ? 'Dashboard' : 'Басқару панелі');
        $welcome = $lang == 'ru' ? 'Система учета товаров на складе' : ($lang == 'en' ? 'Warehouse Inventory Management System' : 'Қойма тауарларын есепке алу жүйесі');
        $subtitle = $lang == 'ru'
            ? 'Современное и удобное веб-приложение для управления товарами, категориями и складскими остатками.'
            : ($lang == 'en'
                ? 'A modern and convenient web application for managing products, categories, and warehouse stock.'
                : 'Тауарларды, категорияларды және қойма қалдықтарын басқаруға арналған заманауи әрі ыңғайлы веб-қосымша.');

        $totalProductsText = $lang == 'ru' ? 'Общее количество товаров' : ($lang == 'en' ? 'Total Products' : 'Жалпы тауар саны');
        $totalCategoriesText = $lang == 'ru' ? 'Общее количество категорий' : ($lang == 'en' ? 'Total Categories' : 'Жалпы категория саны');
        $lowStockText = $lang == 'ru' ? 'Товары с низким остатком' : ($lang == 'en' ? 'Low Stock Products' : 'Аз қалған тауарлар');
        $productsText = $lang == 'ru' ? 'Последние товары' : ($lang == 'en' ? 'Latest Products' : 'Соңғы тауарлар');
        $nameText = $lang == 'ru' ? 'Название' : ($lang == 'en' ? 'Name' : 'Атауы');
        $quantityText = $lang == 'ru' ? 'Количество' : ($lang == 'en' ? 'Quantity' : 'Саны');
        $priceText = $lang == 'ru' ? 'Цена' : ($lang == 'en' ? 'Price' : 'Бағасы');
        $statusText = $lang == 'ru' ? 'Статус' : ($lang == 'en' ? 'Status' : 'Күйі');
        $noProductsText = $lang == 'ru' ? 'Пока нет товаров' : ($lang == 'en' ? 'No products yet' : 'Әзірге тауар жоқ');
        $inStockText = $lang == 'ru' ? 'В наличии' : ($lang == 'en' ? 'In stock' : 'Қоймада бар');
        $lowText = $lang == 'ru' ? 'Мало' : ($lang == 'en' ? 'Low' : 'Аз');
    @endphp

    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-bold text-2xl text-slate-900 leading-tight">
                {{ $dashboard }}
            </h2>
            <div class="hidden md:flex items-center gap-2 text-sm text-slate-500">
                <span class="w-2 h-2 rounded-full bg-emerald-500"></span>
                System online
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            <div class="relative overflow-hidden bg-gradient-to-r from-slate-950 via-slate-800 to-slate-700 text-white rounded-[28px] shadow-xl p-8 md:p-10 mb-8">
                <div class="max-w-3xl">
                    <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-white/10 border border-white/10 text-xs uppercase tracking-[0.2em] mb-5">
                        WarehouseSys
                    </div>
                    <h1 class="text-3xl md:text-4xl font-bold mb-4 leading-tight">
                        {{ $welcome }}
                    </h1>
                    <p class="text-slate-200 text-base md:text-lg leading-8">
                        {{ $subtitle }}
                    </p>

                    <div class="mt-8 flex flex-wrap gap-3">
                        <a href="{{ route('products.index', ['lang' => $lang]) }}"
                           class="inline-flex items-center px-5 py-3 rounded-2xl bg-white text-slate-900 font-semibold shadow hover:bg-slate-100 transition">
                            {{ $lang == 'ru' ? 'Перейти к товарам' : ($lang == 'en' ? 'Go to Products' : 'Тауарларға өту') }}
                        </a>

                        <a href="{{ route('categories.index', ['lang' => $lang]) }}"
                           class="inline-flex items-center px-5 py-3 rounded-2xl bg-white/10 border border-white/15 text-white font-semibold hover:bg-white/15 transition">
                            {{ $lang == 'ru' ? 'Открыть категории' : ($lang == 'en' ? 'Open Categories' : 'Категорияларды ашу') }}
                        </a>
                    </div>
                </div>

                <div class="absolute -right-10 -bottom-10 w-56 h-56 bg-white/5 rounded-full blur-2xl"></div>
                <div class="absolute right-20 top-10 w-24 h-24 bg-sky-400/10 rounded-full blur-2xl"></div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white rounded-[24px] shadow-sm border border-slate-200 p-6 hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500 mb-2">{{ $totalProductsText }}</p>
                            <p class="text-4xl font-bold text-slate-900">{{ $totalProducts }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-700">
                            📦
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] shadow-sm border border-slate-200 p-6 hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500 mb-2">{{ $totalCategoriesText }}</p>
                            <p class="text-4xl font-bold text-slate-900">{{ $totalCategories }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-slate-100 flex items-center justify-center text-slate-700">
                            🗂️
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-[24px] shadow-sm border border-slate-200 p-6 hover:shadow-md transition">
                    <div class="flex items-start justify-between">
                        <div>
                            <p class="text-sm text-slate-500 mb-2">{{ $lowStockText }}</p>
                            <p class="text-4xl font-bold text-red-600">{{ $lowStockProducts }}</p>
                        </div>
                        <div class="w-12 h-12 rounded-2xl bg-red-50 flex items-center justify-center text-red-600">
                            ⚠️
                        </div>
                    </div>
                </div>
            </div>

            <div class="bg-white rounded-[28px] shadow-sm border border-slate-200 overflow-hidden">
                <div class="flex items-center justify-between px-6 py-5 border-b border-slate-200">
                    <div>
                        <h3 class="text-xl font-bold text-slate-900">{{ $productsText }}</h3>
                        <p class="text-sm text-slate-500 mt-1">WarehouseSys overview</p>
                    </div>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $nameText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $quantityText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $priceText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $statusText }}</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                        @forelse($latestProducts as $product)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-medium text-slate-900">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $product->quantity }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $product->price }}</td>
                                <td class="px-6 py-4">
                                    @if($product->quantity <= 5)
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-700">
                                                {{ $lowText }}
                                            </span>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-emerald-100 text-emerald-700">
                                                {{ $inStockText }}
                                            </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-10 text-center text-slate-500">
                                    {{ $noProductsText }}
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>
