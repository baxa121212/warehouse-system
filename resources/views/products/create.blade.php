<x-app-layout>
    @php
        $lang = request('lang', 'kk');

        $title = $lang == 'ru' ? 'Добавить товар' : ($lang == 'en' ? 'Add Product' : 'Тауар қосу');
        $subtitle = $lang == 'ru'
            ? 'Заполните информацию о новом товаре'
            : ($lang == 'en' ? 'Fill in the information about the new product' : 'Жаңа тауар туралы мәліметті толтырыңыз');

        $nameText = $lang == 'ru' ? 'Название товара' : ($lang == 'en' ? 'Product Name' : 'Тауар атауы');
        $descriptionText = $lang == 'ru' ? 'Описание' : ($lang == 'en' ? 'Description' : 'Сипаттама');
        $quantityText = $lang == 'ru' ? 'Количество' : ($lang == 'en' ? 'Quantity' : 'Саны');
        $priceText = $lang == 'ru' ? 'Цена' : ($lang == 'en' ? 'Price' : 'Бағасы');
        $categoryText = $lang == 'ru' ? 'Категория' : ($lang == 'en' ? 'Category' : 'Категория');
        $saveText = $lang == 'ru' ? 'Сохранить' : ($lang == 'en' ? 'Save' : 'Сақтау');
        $backText = $lang == 'ru' ? 'Назад' : ($lang == 'en' ? 'Back' : 'Артқа');
        $placeholderDesc = $lang == 'ru' ? 'Введите описание товара' : ($lang == 'en' ? 'Enter product description' : 'Тауар сипаттамасын енгізіңіз');
    @endphp

    <x-slot name="header">
        <div>
            <h2 class="text-2xl font-bold text-slate-900">{{ $title }}</h2>
            <p class="text-sm text-slate-500 mt-1">{{ $subtitle }}</p>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-[28px] shadow-sm border border-slate-200 p-8">
                <form action="{{ route('products.store', ['lang' => $lang]) }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">{{ $nameText }}</label>
                        <input type="text" name="name" value="{{ old('name') }}"
                               class="w-full rounded-2xl border-slate-300 focus:border-slate-500 focus:ring-slate-500">
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">{{ $descriptionText }}</label>
                        <textarea name="description" rows="4"
                                  class="w-full rounded-2xl border-slate-300 focus:border-slate-500 focus:ring-slate-500"
                                  placeholder="{{ $placeholderDesc }}">{{ old('description') }}</textarea>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">{{ $quantityText }}</label>
                            <input type="number" name="quantity" value="{{ old('quantity') }}"
                                   class="w-full rounded-2xl border-slate-300 focus:border-slate-500 focus:ring-slate-500">
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-2">{{ $priceText }}</label>
                            <input type="number" step="0.01" name="price" value="{{ old('price') }}"
                                   class="w-full rounded-2xl border-slate-300 focus:border-slate-500 focus:ring-slate-500">
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-semibold text-slate-700 mb-2">{{ $categoryText }}</label>
                        <select name="category_id"
                                class="w-full rounded-2xl border-slate-300 focus:border-slate-500 focus:ring-slate-500">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="flex items-center gap-3 pt-4">
                        <button type="submit"
                                class="inline-flex items-center px-5 py-3 rounded-2xl bg-slate-900 text-white font-semibold hover:bg-slate-800 transition">
                            {{ $saveText }}
                        </button>

                        <a href="{{ route('products.index', ['lang' => $lang]) }}"
                           class="inline-flex items-center px-5 py-3 rounded-2xl bg-slate-100 text-slate-700 font-semibold hover:bg-slate-200 transition">
                            {{ $backText }}
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
