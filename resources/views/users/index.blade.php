@php
$pageTitle = request()->get('tab', 'users') === 'roles' ? 'Roles & Permissions' : 'Users';
@endphp

@extends('layouts.app')

@section('title', 'Users & Roles - ' . $pageTitle)

@section('content')
    <div x-data="{ 
        currentTab: '{{ request()->get('tab', 'users') }}',
        openModal: false,
        modalType: 'user'
    }" class="min-h-screen">
        
        <x-page-heading :title="$pageTitle" description="Manage team members and access levels">
            <button x-show="currentTab === 'users'" @click="openModal = true; modalType = 'user'" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                + New User
            </button>
            <button x-show="currentTab === 'roles'" @click="openModal = true; modalType = 'role'" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">
                + New Role
            </button>
        </x-page-heading>

        <div class="mt-6">
            <div class="border-b border-slate-200">
                <nav class="flex gap-6">
                    <a href="{{ route('users.index', ['tab' => 'users']) }}" :class="currentTab === 'users' ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700'" class="pb-3 text-sm font-medium border-b-2 transition-colors">
                        Users
                    </a>
                    <a href="{{ route('users.index', ['tab' => 'roles']) }}" :class="currentTab === 'roles' ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700'" class="pb-3 text-sm font-medium border-b-2 transition-colors">
                        Roles & Permissions
                    </a>
                </nav>
            </div>
        </div>

        <!-- Users Tab -->
        <div class="mt-6" x-show="currentTab === 'users'" x-transition.opacity>
            <div class="rounded-2xl bg-white shadow-sm border border-slate-100 overflow-hidden">
                <table class="w-full">
                    <thead class="bg-slate-50">
                        <tr>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">User</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Role</th>
                            <th class="px-6 py-4 text-left text-xs font-semibold uppercase text-slate-500">Joined</th>
                            <th class="px-6 py-4 text-right text-xs font-semibold uppercase text-slate-500">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($users as $user)
                            <tr class="hover:bg-slate-50 transition-colors">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="flex h-10 w-10 items-center justify-center rounded-full bg-slate-900 text-white text-sm font-semibold">
                                            {{ strtoupper(substr($user->name, 0, 2)) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-slate-900">{{ $user->name }}</p>
                                            <p class="text-sm text-slate-500">{{ $user->email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @if($user->role)
                                        <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">
                                            {{ $user->role->name }}
                                        </span>
                                    @else
                                        <span class="text-sm text-slate-400">No role</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-sm text-slate-500">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex items-center justify-end gap-2">
                                        @if($user->id !== auth()->user()->id)
                                            <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors">
                                                    <i class="ph ph-trash text-lg"></i>
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-500">
                                    No users yet. Create your first user to get started.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Roles Tab -->
        <div class="mt-6" x-show="currentTab === 'roles'" x-transition.opacity>
            <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                @forelse($roles as $role)
                    <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100 transition-all hover:shadow-lg">
                        <div class="flex items-start justify-between mb-4">
                            <div>
                                <h3 class="text-lg font-semibold text-slate-900">{{ $role->name }}</h3>
                                <p class="text-sm text-slate-500">{{ $role->users_count }} users</p>
                            </div>
                            @if($role->name !== 'Admin')
                                <form method="POST" action="{{ route('roles.destroy', $role) }}" onsubmit="return confirm('Delete this role?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600 transition-colors">
                                        <i class="ph ph-trash text-lg"></i>
                                    </button>
                                </form>
                            @endif
                        </div>
                        
                        <div class="space-y-2">
                            <p class="text-xs font-semibold uppercase tracking-wide text-slate-400">Permissions:</p>
                            <div class="flex flex-wrap gap-1.5">
                                @forelse($role->permissions ?? [] as $permission)
                                    <span class="inline-flex items-center rounded-full bg-slate-100 px-2.5 py-1 text-xs text-slate-600">
                                        {{ $permission }}
                                    </span>
                                @empty
                                    <span class="text-sm text-slate-400">No permissions</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full py-12 text-center text-slate-500">
                        No roles configured yet.
                    </div>
                @endforelse
            </div>

            <button @click="openModal = true; modalType = 'role'" class="mt-6 rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition-colors">
                + New Role
            </button>
        </div>
    </div>

    <template x-if="openModal && modalType === 'user'">
        <div x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" @click.outside="openModal = false">
            <div x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="w-full max-w-md max-h-[90vh] overflow-hidden">
                <div class="rounded-2xl bg-white shadow-xl overflow-y-auto max-h-[90vh]">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Create New User</h3>
                        <form method="POST" action="{{ route('users.store') }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                                    <input type="text" name="name" required class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none transition-colors" placeholder="e.g., John Doe">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                                    <input type="email" name="email" required class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none transition-colors" placeholder="e.g., john@example.com">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                                    <input type="password" name="password" required min="6" class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none transition-colors" placeholder="At least 6 characters">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                                    <select name="role_id" class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none transition-colors">
                                        <option value="">No Role</option>
                                        @foreach(\App\Models\Role::all() as $role)
                                            <option value="{{ $role->id }}">{{ $role->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" @click="openModal = false" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300 transition-colors">Cancel</button>
                                <button type="submit" class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition-colors">Create User</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>

    <template x-if="openModal && modalType === 'role'">
        <div x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/50 p-4" @click.outside="openModal = false">
            <div x-transition:enter="transition ease-out duration-200" x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-95" class="w-full max-w-md max-h-[90vh] overflow-hidden">
                <div class="rounded-2xl bg-white shadow-xl overflow-y-auto max-h-[90vh]">
                    <div class="p-6">
                        <h3 class="text-lg font-semibold text-slate-900 mb-4">Create New Role</h3>
                        <form method="POST" action="{{ route('roles.store') }}">
                            @csrf
                            <div class="space-y-4">
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Role Name</label>
                                    <input type="text" name="name" required class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none transition-colors" placeholder="e.g., Supervisor">
                                </div>
                                <div>
                                    <label class="block text-sm font-medium text-slate-700 mb-1">Permissions</label>
                                    <div class="space-y-3 max-h-60 overflow-y-auto border border-slate-200 rounded-xl p-4">
                                        @php
                                            $allPermissions = [
                                                'products' => ['view', 'create', 'edit', 'delete'],
                                                'customers' => ['view', 'create', 'edit', 'delete'],
                                                'suppliers' => ['view', 'create', 'edit', 'delete'],
                                                'invoices' => ['view', 'create', 'edit', 'cancel'],
                                                'payments' => ['view', 'create', 'edit'],
                                                'inventory' => ['view', 'adjust'],
                                                'reports' => ['view', 'export'],
                                            ];
                                        @endphp
                                        @foreach($allPermissions as $category => $perms)
                                            <div class="mb-3 last:mb-0">
                                                <p class="text-xs font-semibold uppercase tracking-wide text-slate-400 mb-2">{{ $category }}</p>
                                                <div class="space-y-1.5">
                                                    @foreach($perms as $perm)
                                                        <label class="flex items-center gap-2.5 cursor-pointer hover:bg-slate-50 rounded px-2 py-1 transition-colors">
                                                            <input type="checkbox" name="permissions[]" value="{{ $category }}.{{ $perm }}" class="rounded border-slate-300 text-slate-900 focus:ring-slate-500">
                                                            <span class="text-sm text-slate-600">{{ $category }}.{{ $perm }}</span>
                                                        </label>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6 flex justify-end gap-3">
                                <button type="button" @click="openModal = false" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300 transition-colors">Cancel</button>
                                <button type="submit" class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800 transition-colors">Create Role</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </template>
@endsection
