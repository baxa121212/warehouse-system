<x-guest-layout>
    @php
        $lang = request('lang', 'kk');

        $title = $lang == 'ru' ? 'Вход' : ($lang == 'en' ? 'Login' : 'Кіру');
        $emailText = 'Email';
        $passwordText = $lang == 'ru' ? 'Пароль' : ($lang == 'en' ? 'Password' : 'Құпия сөз');
        $loginText = $lang == 'ru' ? 'Войти' : ($lang == 'en' ? 'Login' : 'Кіру');
    @endphp

    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-slate-900 to-slate-700 px-4">

        <!-- 🌍 LANG -->
        <div class="fixed top-5 right-5 z-50 flex gap-3 bg-white/90 px-4 py-2 rounded-xl shadow">
            <a href="?lang=kk">ҚАЗ</a>
            <a href="?lang=ru">РУС</a>
            <a href="?lang=en">ENG</a>
        </div>

        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">

            <h2 class="text-xl font-bold mb-4">{{ $title }}</h2>

            <!-- ❗ ERRORS -->
            @if ($errors->any())
                <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                    @foreach ($errors->all() as $error)
                        <div>• {{ $error }}</div>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <input type="hidden" name="lang" value="{{ $lang }}">

                <div class="mb-3">
                    <label>{{ $emailText }}</label>
                    <input type="email" name="email" class="w-full border rounded p-2" required>
                </div>

                <div class="mb-3">
                    <label>{{ $passwordText }}</label>
                    <input type="password" name="password" class="w-full border rounded p-2" required>
                </div>

                <button class="w-full bg-slate-900 text-white py-2 rounded">
                    {{ $loginText }}
                </button>
            </form>

            <div class="mt-4 text-sm text-center">
                <a href="{{ route('register', ['lang'=>$lang]) }}">
                    Тіркелу / Register
                </a>
            </div>

        </div>
    </div>
</x-guest-layout>
