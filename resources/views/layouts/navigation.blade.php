<nav x-data="{ open: false }" class="bg-white/95 backdrop-blur border-b border-slate-200 sticky top-0 z-50">
    @php
        $lang = request('lang', 'kk');
        $dashboardText = $lang == 'ru' ? 'Панель управления' : ($lang == 'en' ? 'Dashboard' : 'Басқару панелі');
        $productsText = $lang == 'ru' ? 'Товары' : ($lang == 'en' ? 'Products' : 'Тауарлар');
        $categoriesText = $lang == 'ru' ? 'Категории' : ($lang == 'en' ? 'Categories' : 'Категориялар');
        $logoutText = $lang == 'ru' ? 'Выйти' : ($lang == 'en' ? 'Logout' : 'Шығу');
    @endphp

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between items-center h-16">
            <div class="flex items-center gap-10">
                <a href="{{ route('dashboard', ['lang' => $lang]) }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-xl bg-slate-900 text-white flex items-center justify-center shadow-md font-bold">
                        W
                    </div>
                    <div>
                        <div class="text-lg font-bold text-slate-900">WarehouseSys</div>
                        <div class="text-xs text-slate-500">Inventory Management</div>
                    </div>
                </a>

                <div class="hidden md:flex items-center gap-2">
                    <a href="{{ route('dashboard', ['lang' => $lang]) }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition {{ request()->routeIs('dashboard') ? 'bg-slate-900 text-white shadow' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        {{ $dashboardText }}
                    </a>

                    <a href="{{ route('products.index', ['lang' => $lang]) }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition {{ request()->routeIs('products.*') ? 'bg-slate-900 text-white shadow' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        {{ $productsText }}
                    </a>

                    <a href="{{ route('categories.index', ['lang' => $lang]) }}"
                       class="px-4 py-2 rounded-xl text-sm font-medium transition {{ request()->routeIs('categories.*') ? 'bg-slate-900 text-white shadow' : 'text-slate-600 hover:bg-slate-100 hover:text-slate-900' }}">
                        {{ $categoriesText }}
                    </a>
                </div>
            </div>

            <div class="hidden md:flex items-center gap-4">
                <div class="flex items-center bg-slate-100 rounded-xl p-1">
                    <a href="{{ url()->current() . '?lang=kk' }}"
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $lang == 'kk' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                        ҚАЗ
                    </a>
                    <a href="{{ url()->current() . '?lang=ru' }}"
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $lang == 'ru' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                        РУС
                    </a>
                    <a href="{{ url()->current() . '?lang=en' }}"
                       class="px-3 py-1.5 rounded-lg text-xs font-semibold {{ $lang == 'en' ? 'bg-white text-slate-900 shadow-sm' : 'text-slate-600 hover:text-slate-900' }}">
                        ENG
                    </a>
                </div>

                <x-dropdown align="right" width="56">
                    <x-slot name="trigger">
                        <button class="flex items-center gap-3 px-3 py-2 rounded-xl border border-slate-200 bg-white hover:bg-slate-50 transition">
                            <div class="w-9 h-9 rounded-full bg-slate-900 text-white flex items-center justify-center text-sm font-bold">
                                {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                            </div>
                            <div class="text-left">
                                <div class="text-sm font-semibold text-slate-800">{{ Auth::user()->name }}</div>
                                <div class="text-xs text-slate-500">Authorized User</div>
                            </div>
                        </button>
                    </x-slot>

                    <x-slot name="content">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <x-dropdown-link :href="route('logout')"
                                             onclick="event.preventDefault(); this.closest('form').submit();">
                                {{ $logoutText }}
                            </x-dropdown-link>
                        </form>
                    </x-slot>
                </x-dropdown>
            </div>
        </div>
    </div>
</nav>
