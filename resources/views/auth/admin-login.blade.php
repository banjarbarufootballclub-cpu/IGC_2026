<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Login Administrator - Turnamen Sepak Bola</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-slate-900 flex items-center justify-center min-h-screen">

    <div class="w-full max-w-md bg-white rounded-xl shadow-2xl overflow-hidden p-8">
        <div class="text-center mb-6">
            <div class="bg-red-700 text-white font-black text-xl py-3 rounded-lg shadow mb-3 tracking-wider">
                ADMIN PANEL
            </div>
            <h2 class="text-xl font-bold text-slate-800">Login Panitia Pusat</h2>
            <p class="text-xs text-slate-500 mt-1">Masukkan akun administrator resmi turnamen</p>
        </div>

        <!-- Session Status / Errors -->
        @if ($errors->any())
            <div class="mb-4 bg-red-50 border-l-4 border-red-500 text-red-700 p-3 rounded text-xs">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form method="POST" action="/admin/login">
            @csrf

            <div class="mb-4">
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Email Administrator</label>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <div class="mb-6">
                <label class="block text-xs font-bold text-slate-700 uppercase mb-1">Password</label>
                <input type="password" name="password" required class="w-full border border-slate-300 rounded-lg px-3 py-2.5 text-sm focus:outline-none focus:ring-2 focus:ring-red-600">
            </div>

            <button type="submit" class="w-full bg-red-700 hover:bg-red-800 text-white font-bold py-3 rounded-lg shadow transition text-sm">
                Masuk ke Panel Admin 🔒
            </button>
        </form>

        <div class="text-center mt-6">
            <a href="/" class="text-xs text-slate-500 hover:underline">← Kembali ke Beranda Utama</a>
        </div>
    </div>

</body>
</html>