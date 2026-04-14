<!DOCTYPE html>
<html lang="en" class="h-full bg-slate-50">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - ERP SaaS</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="h-full font-[Inter] antialiased">
    <div class="flex min-h-full flex-col justify-center py-12 sm:px-6 lg:px-8">
        <div class="sm:mx-auto sm:w-full sm:max-w-md">
            <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-900 text-white font-bold text-lg">
                <img src="https://img.freepik.com/vektor-premium/logo-erp-huruf-erp-desain-logo-huruf-erp-inisial-logo-erp-terhubung-dengan-lingkaran-dan-logo-monogram-huruf-besar-tipografi-erp-untuk-bisnis-teknologi-dan-merek-real-estat_229120-74568.jpg" alt="Logo" class="h-10 w-10 rounded-xl object-cover">
            </div>
            <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-slate-900">Sign in to your account</h2>
            <p class="mt-2 text-center text-sm text-slate-600">
                Don't have an account?
                <a href="{{ route('register') }}" class="font-semibold text-slate-900 hover:text-slate-700">Start free trial</a>
            </p>
        </div>

        <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-md">
            <div class="bg-white px-6 py-12 shadow-sm rounded-3xl border border-slate-100 sm:px-12">
                <form class="space-y-6" action="{{ route('login') }}" method="POST">
                    @csrf
                    <div>
                        <label for="email" class="block text-sm font-semibold text-slate-900">Email address</label>
                        <div class="mt-2">
                            <input id="email" name="email" type="email" autocomplete="email" value="{{ old('email') }}" required 
                                class="block w-full rounded-xl border-slate-200 px-4 py-2.5 text-slate-900 placeholder-slate-400 focus:border-slate-400 focus:ring-0 @error('email') border-red-500 @enderror">
                        </div>
                        @error('email')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-semibold text-slate-900">Password</label>
                        <div class="mt-2 relative">
                            <input id="password" name="password" type="password" autocomplete="current-password" required 
                                class="block w-full rounded-xl border-slate-200 px-4 py-2.5 pr-10 text-slate-900 placeholder-slate-400 focus:border-slate-400 focus:ring-0 @error('password') border-red-500 @enderror">
                            <button type="button" onclick="togglePassword('password')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg id="eye-password" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eye-slash-password" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.572-2.977m2.197-2.197A10.05 10.05 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-2.033 3.525M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember" name="remember" type="checkbox" value="1"
                                class="h-4 w-4 rounded border-slate-300 text-slate-900 focus:ring-slate-900">
                            <label for="remember" class="ml-2 block text-sm text-slate-700">Remember me</label>
                        </div>

                        <div class="text-sm">
                            <a href="#" class="font-semibold text-slate-900 hover:text-slate-700">Forgot password?</a>
                        </div>
                    </div>

                    <div>
                        <button type="submit" 
                            class="flex w-full justify-center rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-sm hover:bg-slate-800 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-slate-900">
                            Sign in
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const eyeIcon = document.getElementById('eye-' + inputId);
            const eyeSlashIcon = document.getElementById('eye-slash-' + inputId);
            
            if (input.type === 'password') {
                input.type = 'text';
                eyeIcon.classList.add('hidden');
                eyeSlashIcon.classList.remove('hidden');
            } else {
                input.type = 'password';
                eyeIcon.classList.remove('hidden');
                eyeSlashIcon.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
