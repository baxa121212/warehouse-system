<x-app-layout>
    @php
        $lang = request('lang', 'kk');

        $title = $lang == 'ru' ? 'Категории' : ($lang == 'en' ? 'Categories' : 'Категориялар');
        $subtitle = $lang == 'ru'
            ? 'Список категорий товаров'
            : ($lang == 'en' ? 'List of product categories' : 'Тауар категорияларының тізімі');

        $addText = $lang == 'ru' ? 'Добавить категорию' : ($lang == 'en' ? 'Add Category' : 'Категория қосу');
        $idText = 'ID';
        $nameText = $lang == 'ru' ? 'Название' : ($lang == 'en' ? 'Name' : 'Атауы');
        $actionText = $lang == 'ru' ? 'Действие' : ($lang == 'en' ? 'Action' : 'Әрекет');
        $deleteText = $lang == 'ru' ? 'Удалить' : ($lang == 'en' ? 'Delete' : 'Өшіру');
        $emptyText = $lang == 'ru' ? 'Пока нет категорий' : ($lang == 'en' ? 'No categories yet' : 'Әзірге категория жоқ');
    @endphp

    <x-slot name="header">
        <div class="flex items-center justify-between gap-4">
            <div>
                <h2 class="text-2xl font-bold text-slate-900">{{ $title }}</h2>
                <p class="text-sm text-slate-500 mt-1">{{ $subtitle }}</p>
            </div>

            <a href="{{ route('categories.create', ['lang' => $lang]) }}"
               class="inline-flex items-center px-5 py-3 rounded-2xl bg-slate-900 text-white font-semibold shadow hover:bg-slate-800 transition">
                {{ $addText }}
            </a>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[28px] shadow-sm border border-slate-200 overflow-hidden">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $idText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $nameText }}</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">{{ $actionText }}</th>
                        </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200">
                        @forelse($categories as $category)
                            <tr class="hover:bg-slate-50 transition">
                                <td class="px-6 py-4 text-slate-700">{{ $category->id }}</td>
                                <td class="px-6 py-4 font-semibold text-slate-900">{{ $category->name }}</td>
                                <td class="px-6 py-4">
                                    <form action="{{ route('categories.destroy', ['category' => $category->id, 'lang' => $lang]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="inline-flex items-center px-3 py-2 rounded-xl bg-red-600 text-white text-sm font-medium hover:bg-red-500 transition">
                                            {{ $deleteText }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" class="px-6 py-10 text-center text-slate-500">
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
