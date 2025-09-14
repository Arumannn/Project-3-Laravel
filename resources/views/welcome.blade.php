<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - Login</title>
    @vite('resources/css/app.css') {{-- Pastikan Tailwind jalan --}}
    <style>
        body {
            background-color: #000;
            color: #fff;
            margin: 0;
            font-family: Arial, sans-serif;
        }

        header {
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 1rem 2rem;
            position: relative;
            z-index: 20;
        }

        .logo {
            font-size: 2rem;
            font-weight: bold;
        }

        .nav-links {
            display: flex;
            gap: 2rem;
            font-size: 1rem;
        }

        .nav-links a {
            color: #fff;
            text-decoration: none;
        }

        .main-content {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: calc(100vh - 4rem);
            text-align: center;
            background-image: url('{{ asset('images/Home.jpg') }}');
            background-size: cover;
            background-position: center;
            position: relative;
        }

        .main-content:before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.6);
        }

        .content-wrapper {
            position: relative;
            z-index: 10;
            width: 100%;
            max-width: 420px;
            color: black;
            opacity: 0.9;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">Akademik</div>
    </header>

    <section class="main-content">
        <div class="content-wrapper">
            <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
                <div class="mb-4 text-center">
                    <h2 class="text-2xl font-semibold text-gray-800">Login</h2>
                    <p class="text-gray-600 text-sm">Enter your credentials to access the system</p>
                </div>

                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 font-medium text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Email Address -->
                    <div>
                        <label for="email" class="block font-medium text-sm text-gray-700">Email</label>
                        <input id="email" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                               type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username" />
                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mt-4">
                        <label for="password" class="block font-medium text-sm text-gray-700">Password</label>
                        <input id="password" class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                               type="password" name="password" required autocomplete="current-password" />
                        @error('password')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="block mt-4">
                        <label for="remember_me" class="inline-flex items-center">
                            <input id="remember_me" type="checkbox"
                                   class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500"
                                   name="remember">
                            <span class="ms-2 text-sm text-gray-600">Remember me</span>
                        </label>
                    </div>

                    <div class="flex items-center justify-center mt-4">
                        <button type="submit"
                                class="w-full inline-flex items-center justify-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            Log in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</body>
</html>
