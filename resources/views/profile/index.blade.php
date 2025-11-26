@extends('layouts.app')

@section('content')
<div class="p-8">
    <div class="mx-auto max-w-3xl">
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-slate-900">Profile Settings</h1>
            <p class="mt-2 text-slate-600">Update your personal information and password</p>
        </div>

        @if (session('success'))
            <div class="mb-6 rounded-2xl bg-emerald-50 border border-emerald-200 p-4">
                <div class="flex items-center gap-3">
                    <svg class="h-5 w-5 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                    <span class="text-sm font-medium text-emerald-800">{{ session('success') }}</span>
                </div>
            </div>
        @endif

        <div class="rounded-3xl border border-slate-200 bg-white p-8">
            <form method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')

                <!-- Name -->
                <div class="mb-6">
                    <label for="name" class="mb-2 block text-sm font-semibold text-slate-700">Name</label>
                    <input type="text" name="name" id="name" value="{{ old('name', auth()->user()->name) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20"
                        required>
                    @error('name')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-6">
                    <label for="email" class="mb-2 block text-sm font-semibold text-slate-700">Email</label>
                    <input type="email" name="email" id="email" value="{{ old('email', auth()->user()->email) }}"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20"
                        required>
                    @error('email')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <div class="my-8 border-t border-slate-200"></div>

                <h3 class="mb-4 text-lg font-semibold text-slate-900">Change Password</h3>
                <p class="mb-6 text-sm text-slate-600">Leave blank if you don't want to change your password</p>

                <!-- Current Password -->
                <div class="mb-6">
                    <label for="current_password" class="mb-2 block text-sm font-semibold text-slate-700">Current Password</label>
                    <input type="password" name="current_password" id="current_password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20">
                    @error('current_password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- New Password -->
                <div class="mb-6">
                    <label for="password" class="mb-2 block text-sm font-semibold text-slate-700">New Password</label>
                    <input type="password" name="password" id="password"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20">
                    @error('password')
                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mb-8">
                    <label for="password_confirmation" class="mb-2 block text-sm font-semibold text-slate-700">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-slate-900 focus:border-slate-500 focus:outline-none focus:ring-2 focus:ring-slate-500/20">
                </div>

                <div class="flex items-center gap-4">
                    <button type="submit" class="rounded-xl bg-slate-900 px-6 py-2.5 text-sm font-semibold text-white hover:bg-slate-800">
                        Save Changes
                    </button>
                    <a href="{{ url()->previous() }}" class="rounded-xl border border-slate-300 px-6 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
