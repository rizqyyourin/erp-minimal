@extends('layouts.app')

@section('content')
<div class="p-8">
    <div class="mx-auto max-w-2xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Delete Account</h1>
            <p class="mt-2 text-slate-600">Permanently delete your account and all associated data</p>
        </div>

        <div class="rounded-3xl border border-red-200 bg-red-50 p-8">
            <div class="mb-6 flex items-start gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-full bg-red-100">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-red-900">Warning: This action cannot be undone</h3>
                    <p class="mt-2 text-sm text-red-800">
                        Deleting your account will permanently remove:
                    </p>
                    <ul class="mt-3 space-y-2 text-sm text-red-800">
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Your profile and account information
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            All products, customers, and suppliers
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            All invoices and payment records
                        </li>
                        <li class="flex items-center gap-2">
                            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            All inventory transactions
                        </li>
                    </ul>
                </div>
            </div>

            <div x-data="{ showModal: false }" class="mt-8 rounded-2xl border border-red-300 bg-white p-6">
                <h4 class="mb-4 font-semibold text-slate-900">Confirm Account Deletion</h4>
                <p class="mb-4 text-sm text-slate-600">To proceed, please enter your password:</p>

                <form id="deleteAccountForm" method="POST" action="{{ route('account.destroy') }}">
                    @csrf
                    @method('DELETE')

                    <div class="mb-6">
                        <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="password"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 pr-10 text-slate-900 focus:border-red-500 focus:outline-none focus:ring-2 focus:ring-red-500/20"
                                required>
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

                    <div class="flex items-center gap-4">
                        <button type="button" 
                            x-on:click="showModal = true"
                            class="rounded-xl bg-red-600 px-6 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                            Delete My Account
                        </button>
                        <a href="{{ route('dashboard') }}" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                            Cancel
                        </a>
                    </div>
                </form>

                <!-- Delete Confirmation Modal -->
                <div x-show="showModal" 
                    x-transition:enter="transition ease-out duration-200"
                    x-transition:enter-start="opacity-0"
                    x-transition:enter-end="opacity-100"
                    x-transition:leave="transition ease-in duration-150"
                    x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0"
                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 backdrop-blur-sm"
                    style="display: none;">
                    <div x-show="showModal"
                        x-transition:enter="transition ease-out duration-200"
                        x-transition:enter-start="opacity-0 scale-95"
                        x-transition:enter-end="opacity-100 scale-100"
                        x-transition:leave="transition ease-in duration-150"
                        x-transition:leave-start="opacity-100 scale-100"
                        x-transition:leave-end="opacity-0 scale-95"
                        x-on:click.away="showModal = false"
                        class="mx-4 w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl">
                        
                        <!-- Modal Header -->
                        <div class="mb-6 text-center">
                            <div class="mx-auto mb-4 flex h-16 w-16 items-center justify-center rounded-full bg-red-100">
                                <svg class="h-8 w-8 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z" />
                                </svg>
                            </div>
                            <h3 class="text-xl font-bold text-slate-900">Delete Your Account?</h3>
                            <p class="mt-2 text-sm text-slate-500">
                                This action is <span class="font-semibold text-red-600">permanent</span> and cannot be undone. All your data will be lost forever.
                            </p>
                        </div>

                        <!-- Modal Actions -->
                        <div class="flex gap-3">
                            <button type="button" 
                                x-on:click="showModal = false"
                                class="flex-1 rounded-xl border border-slate-300 px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                                No, Keep My Account
                            </button>
                            <button type="button" 
                                x-on:click="document.getElementById('deleteAccountForm').submit()"
                                class="flex-1 rounded-xl bg-red-600 px-4 py-3 text-sm font-semibold text-white hover:bg-red-700">
                                Yes, Delete Forever
                            </button>
                        </div>
                    </div>
                </div>
            </div>
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
@endsection
