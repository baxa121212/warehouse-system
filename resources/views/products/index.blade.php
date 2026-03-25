<x-app-layout>
    @php
        $lang = request('lang', 'kk');

        $title = $lang == 'ru' ? 'Товары' : ($lang == 'en' ? 'Products' : 'Тауарлар');
        $subtitle = $lang == 'ru'
            ? 'Список всех товаров на складе'
            : ($lang == 'en' ? 'List of all products in stock' : 'Қоймадағы барлық тауарлар тізімі');

        $addText = $lang == 'ru' ? 'Добавить товар' : ($lang == 'en' ? 'Add Product' : 'Тауар қосу');
        $nameText = $lang == 'ru' ? 'Название' : ($lang == 'en' ? 'Name' : 'Атауы');
        $categoryText = $lang == 'ru' ? 'Категория' : ($lang == 'en' ? 'Category' : 'Категория');
        $quantityText = $lang == 'ru' ? 'Количество' : ($lang == 'en' ? 'Quantity' : 'Саны');
        $priceText = $lang == 'ru' ? 'Цена' : ($lang == 'en' ? 'Price' : 'Бағасы');
        $userText = $lang == 'ru' ? 'Пользователь' : ($lang == 'en' ? 'User' : 'Қолданушы');
        $statusText = $lang == 'ru' ? 'Статус' : ($lang == 'en' ? 'Status' : 'Күйі');
        $actionText = $lang == 'ru' ? 'Действие' : ($lang == 'en' ? 'Action' : 'Әрекет');
        $editText = $lang == 'ru' ? 'Редактировать' : ($lang == 'en' ? 'Edit' : 'Өңдеу');
        $deleteText = $lang == 'ru' ? 'Удалить' : ($lang == 'en' ? 'Delete' : 'Өшіру');
        $emptyText = $lang == 'ru' ? 'Пока нет товаров' : ($lang == 'en' ? 'No products yet' : 'Әзірге тауар жоқ');
        $inStockText = $lang == 'ru' ? 'В наличии' : ($lang == 'en' ? 'In stock' : 'Қоймада бар');
        $lowText = $lang == 'ru' ? 'Мало' : ($lang == 'en' ? 'Low' : 'Аз');
    @endphp

    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">{{ $title }}</h2>
                <p class="text-sm text-slate-500 mt-1">{{ $subtitle }}</p>
            </div>

            <a href="{{ route('products.create', ['lang' => $lang]) }}"
               class="inline-flex items-center px-5 py-3 rounded-2xl bg-slate-900 text-white font-semibold shadow hover:bg-slate-800 transition">
                {{ $addText }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[28px] shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $nameText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $categoryText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $quantityText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $priceText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $userText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $statusText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $actionText }}</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                        @forelse($products as $product)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 font-semibold text-slate-900">{{ $product->name }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $product->category->name }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $product->quantity }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $product->price }}</td>
                                <td class="px-6 py-4 text-slate-700">{{ $product->user->name }}</td>
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
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-2">
                                        <a href="{{ route('products.edit', ['product' => $product->id, 'lang' => $lang]) }}"
                                           class="inline-flex items-center px-3 py-2 rounded-xl bg-blue-600 text-white text-sm font-medium hover:bg-blue-500 transition">
                                            {{ $editText }}
                                        </a>

                                        <form action="{{ route('products.destroy', ['product' => $product->id, 'lang' => $lang]) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="inline-flex items-center px-3 py-2 rounded-xl bg-red-600 text-white text-sm font-medium hover:bg-red-500 transition">
                                                {{ $deleteText }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-10 text-center text-slate-500">
                                    {{ $emptyText }}
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
