<x-app-layout>
    @php
        $lang = request('lang', 'kk');

        $title = $lang == 'ru' ? 'Добавить категорию' : ($lang == 'en' ? 'Add Category' : 'Категория қосу');
        $subtitle = $lang == 'ru'
            ? 'Создайте новую категорию для товаров'
            : ($lang == 'en' ? 'Create a new category for products' : 'Тауарлар үшін жаңа категория жасаңыз');

        $nameText = $lang == 'ru' ? 'Название категории' : ($lang == 'en' ? 'Category Name' : 'Категория атауы');
        $saveText = $lang == 'ru' ? 'Сохранить' : ($lang == 'en' ? 'Save' : 'Сақтау');
        $backText = $lang == 'ru' ? 'Назад' : ($lang == 'en' ? 'Back' : 'Артқа');
    @endphp

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">{{ $title }}</h2>
            <p class="text-sm text-slate-500 mt-1">{{ $subtitle }}</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[28px] shadow-sm border border-slate-200 p-8">
                <form action="{{ route('categories.store', ['lang' => $lang]) }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">{{ $nameText }}</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded-2xl border-slate-300 focus:border-slate-500 focus:ring-slate-500">
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="submit"
                                class="inline-flex items-center px-5 py-3 rounded-2xl bg-slate-900 text-white font-semibold hover:bg-slate-800 transition">
                            {{ $saveText }}
                        </button>

                        <a href="{{ route('categories.index', ['lang' => $lang]) }}"
                           class="inline-flex items-center px-5 py-3 rounded-2xl bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition">
                            {{ $backText }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
