@extends('layouts.app')

@section('title', 'Users & Roles')

@section('content')
    <x-page-heading title="User Management" description="Manage users and their roles with permissions">
        <x-slot name="actions">
            @if($tab === 'users')
                @can('users.create')
                <button onclick="document.getElementById('createUserModal').showModal()" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">+ New User</button>
                @endcan
            @else
                @can('roles.manage')
                <button onclick="document.getElementById('createRoleModal').showModal()" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">+ New Role</button>
                @endcan
            @endif
        </x-slot>
    </x-page-heading>

    {{-- Tabs --}}
    <div class="mb-6 border-b border-slate-200">
        <nav class="flex gap-8">
            <a href="{{ route('users.index', ['tab' => 'users']) }}" class="border-b-2 px-1 pb-4 text-sm font-semibold {{ $tab === 'users' ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                Users
            </a>
            <a href="{{ route('users.index', ['tab' => 'roles']) }}" class="border-b-2 px-1 pb-4 text-sm font-semibold {{ $tab === 'roles' ? 'border-slate-900 text-slate-900' : 'border-transparent text-slate-500 hover:text-slate-700' }}">
                Roles
            </a>
        </nav>
    </div>

    <div class="rounded-3xl border border-slate-100 bg-white p-6 shadow-[0_20px_60px_-35px_rgba(15,23,42,0.5)]">
        @if($tab === 'users')
            {{-- Users Table --}}
            <div class="overflow-hidden rounded-2xl border border-slate-100">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase text-slate-500">
                        <tr>
                            <th class="px-6 py-3 text-left">Name</th>
                            <th class="px-6 py-3 text-left">Email</th>
                            <th class="px-6 py-3 text-left">Role</th>
                            <th class="px-6 py-3 text-left">Created</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($users ?? [] as $user)
                            <tr>
                                <td class="px-6 py-4 text-slate-900">
                                    <p class="font-semibold">{{ $user->name }}</p>
                                </td>
                                <td class="px-6 py-4 text-slate-500">{{ $user->email }}</td>
                                <td class="px-6 py-4">
                                    <span class="rounded-full px-3 py-1 text-xs font-semibold bg-slate-100 text-slate-700">
                                        {{ $user->role?->name ?? 'No Role' }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-slate-500">{{ $user->created_at?->format('M d, Y') }}</td>
                                <td class="px-6 py-4 text-right">
                                    @can('users.edit')
                                    <button onclick="editUser({{ $user->id }}, '{{ addslashes($user->name) }}', '{{ $user->email }}', {{ $user->role_id ?? 'null' }})" class="rounded-2xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:border-slate-300 me-2">Edit</button>
                                    @endcan
                                    @can('users.delete')
                                    @if(auth()->id() !== $user->id)
                                        <button onclick="openDeleteModal({{ $user->id }}, '{{ addslashes($user->name) }}')" class="rounded-2xl border border-red-200 px-3 py-1 text-xs font-semibold text-red-600 hover:border-red-300">Delete</button>
                                    @endif
                                    @endcan
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-16 text-center">
                                    <p class="text-sm text-slate-500">No users yet</p>
                                    @can('users.create')
                                    <button onclick="document.getElementById('createUserModal').showModal()" class="mt-3 inline-block rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Add your first user</button>
                                    @endcan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @else
            {{-- Roles Table --}}
            <div class="overflow-hidden rounded-2xl border border-slate-100">
                <table class="min-w-full divide-y divide-slate-100 text-sm">
                    <thead class="bg-slate-50 text-xs font-semibold uppercase text-slate-500">
                        <tr>
                            <th class="px-6 py-3 text-left">Role Name</th>
                            <th class="px-6 py-3 text-left">Users Count</th>
                            <th class="px-6 py-3 text-left">Permissions</th>
                            <th class="px-6 py-3"></th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100 bg-white">
                        @forelse($roles ?? [] as $role)
                            <tr>
                                <td class="px-6 py-4 text-slate-900">
                                    <p class="font-semibold">{{ $role->name }}</p>
                                </td>
                                <td class="px-6 py-4 text-slate-500">
                                    <button onclick="showRoleUsers({{ $role->id }}, '{{ addslashes($role->name) }}')" class="text-blue-600 hover:underline font-medium">
                                        {{ $role->users_count }} users
                                    </button>
                                </td>
                                <td class="px-6 py-4">
                                    @if($role->permissions && count($role->permissions) > 0)
                                        @if(in_array('*', $role->permissions))
                                            <span class="rounded-full px-3 py-1 text-xs font-semibold bg-emerald-50 text-emerald-700">All Permissions</span>
                                        @else
                                            <div class="flex flex-wrap gap-1">
                                                @foreach($role->permissions as $permission)
                                                    <span class="rounded-full px-2 py-1 text-xs bg-slate-100 text-slate-600">{{ $permission }}</span>
                                                @endforeach
                                            </div>
                                        @endif
                                    @else
                                        <span class="text-slate-400 text-xs">No permissions</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <div class="flex justify-end gap-2">
                                        @can('roles.manage')
                                        <button onclick='editRole({{ $role->id }}, "{{ addslashes($role->name) }}", {{ json_encode($role->permissions ?? []) }})' class="rounded-2xl border border-slate-200 px-3 py-1 text-xs font-semibold text-slate-600 hover:border-slate-300">Edit</button>
                                        @if($role->users_count == 0)
                                            <button onclick="openDeleteRoleModal({{ $role->id }}, '{{ addslashes($role->name) }}')" class="rounded-2xl border border-red-200 px-3 py-1 text-xs font-semibold text-red-600 hover:border-red-300">Delete</button>
                                        @endif
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-16 text-center">
                                    <p class="text-sm text-slate-500">No roles yet</p>
                                    @can('roles.manage')
                                    <button onclick="document.getElementById('createRoleModal').showModal()" class="mt-3 inline-block rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Add your first role</button>
                                    @endcan
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    {{-- Create User Modal --}}
    <dialog id="createUserModal" class="rounded-3xl p-0 backdrop:bg-slate-900/50 m-0 max-h-[90vh] overflow-y-auto z-50 w-[90vw] max-w-md border-0">
        <div class="w-full max-w-md p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Create New User</h3>
            <form action="{{ route('users.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                        <input type="text" name="name" required class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-300 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" required class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-300 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Password</label>
                        <div class="relative">
                            <input type="password" name="password" id="createUserPassword" class="w-full rounded-2xl border border-slate-200 px-4 py-2 pr-10 text-sm focus:border-slate-300 focus:outline-none">
                            <button type="button" onclick="togglePassword('createUserPassword')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg id="eye-createUserPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eye-slash-createUserPassword" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.572-2.977m2.197-2.197A10.05 10.05 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-2.033 3.525M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                        <select name="role_id" class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-300 focus:outline-none">
                            <option value="">No Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex gap-3 justify-end">
                    <button type="button" onclick="document.getElementById('createUserModal').close()" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">Cancel</button>
                    <button type="submit" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Create</button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- Edit User Modal --}}
    <dialog id="editUserModal" class="rounded-3xl p-0 backdrop:bg-slate-900/50 m-0 max-h-[90vh] overflow-y-auto z-50 w-[90vw] max-w-md border-0">
        <div class="w-full max-w-md p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Edit User</h3>
            <form id="editUserForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Name</label>
                        <input type="text" name="name" id="editUserName" required class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-300 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Email</label>
                        <input type="email" name="email" id="editUserEmail" required class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-300 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Password (leave blank to keep current)</label>
                        <div class="relative">
                            <input type="password" name="password" id="editUserPassword" class="w-full rounded-2xl border border-slate-200 px-4 py-2 pr-10 text-sm focus:border-slate-300 focus:outline-none">
                            <button type="button" onclick="togglePassword('editUserPassword')" class="absolute inset-y-0 right-0 flex items-center pr-3 text-slate-400 hover:text-slate-600 focus:outline-none">
                                <svg id="eye-editUserPassword" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z" />
                                </svg>
                                <svg id="eye-slash-editUserPassword" class="h-5 w-5 hidden" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.542-7a10.05 10.05 0 011.572-2.977m2.197-2.197A10.05 10.05 0 0112 5c4.478 0 8.268 2.943 9.542 7a10.05 10.05 0 01-2.033 3.525M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3l18 18" />
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Role</label>
                        <select name="role_id" id="editUserRole" class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-300 focus:outline-none">
                            <option value="">No Role</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex gap-3 justify-end">
                    <button type="button" onclick="document.getElementById('editUserModal').close()" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">Cancel</button>
                    <button type="submit" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Update</button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- Delete User Modal --}}
    <dialog id="deleteUserModal" class="rounded-3xl p-0 backdrop:bg-slate-900/50 m-0 max-h-[90vh] overflow-y-auto z-50 w-[90vw] max-w-md border-0">
        <div class="w-full max-w-md p-6">
            <div class="text-center mb-6">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900">Delete User</h3>
                <p class="mt-2 text-sm text-slate-500">Are you sure you want to delete <span id="deleteUserName" class="font-semibold text-slate-900"></span>? This action cannot be undone.</p>
            </div>
            <form id="deleteUserForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('deleteUserModal').close()" class="flex-1 rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                        Yes, Delete
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- Delete Role Modal --}}
    <dialog id="deleteRoleModal" class="rounded-3xl p-0 backdrop:bg-slate-900/50 m-0 max-h-[90vh] overflow-y-auto z-50 w-[90vw] max-w-md border-0">
        <div class="w-full max-w-md p-6">
            <div class="text-center mb-6">
                <div class="mx-auto flex h-12 w-12 items-center justify-center rounded-full bg-red-100 mb-4">
                    <svg class="h-6 w-6 text-red-600" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-slate-900">Delete Role</h3>
                <p class="mt-2 text-sm text-slate-500">Are you sure you want to delete role <span id="deleteRoleName" class="font-semibold text-slate-900"></span>? This action cannot be undone.</p>
            </div>
            <form id="deleteRoleForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex gap-3">
                    <button type="button" onclick="document.getElementById('deleteRoleModal').close()" class="flex-1 rounded-xl border border-slate-300 px-4 py-2.5 text-sm font-semibold text-slate-700 hover:bg-slate-50">
                        Cancel
                    </button>
                    <button type="submit" class="flex-1 rounded-xl bg-red-600 px-4 py-2.5 text-sm font-semibold text-white hover:bg-red-700">
                        Yes, Delete
                    </button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- Create Role Modal --}}
    <dialog id="createRoleModal" class="rounded-3xl p-0 backdrop:bg-slate-900/50 m-0 max-h-[90vh] overflow-y-auto z-50 w-[90vw] max-w-lg border-0">
        <div class="w-full max-w-lg p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Create New Role</h3>
            <form action="{{ route('roles.store') }}" method="POST">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Role Name</label>
                        <input type="text" name="name" required class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-300 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-3">Permissions</label>
                        <div class="space-y-3">
                            @foreach($allPermissions as $module => $perms)
                                <div class="border border-slate-100 rounded-xl p-3">
                                    <p class="font-semibold text-sm text-slate-700 mb-2 capitalize">{{ $module }}</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($perms as $perm)
                                            <label class="flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-50 hover:bg-slate-100 cursor-pointer">
                                                <input type="checkbox" name="permissions[]" value="{{ $module }}.{{ $perm }}" class="rounded border-slate-300">
                                                <span class="text-sm text-slate-600 capitalize">{{ $perm }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <label class="flex items-center gap-2 mt-4 px-3 py-2 rounded-lg bg-emerald-50 cursor-pointer">
                            <input type="checkbox" name="permissions[]" value="*" class="rounded border-slate-300" onchange="toggleAllPermissions(this)">
                            <span class="text-sm font-semibold text-emerald-700">Grant All Permissions (Super Admin)</span>
                        </label>
                    </div>
                </div>
                <div class="mt-6 flex gap-3 justify-end">
                    <button type="button" onclick="document.getElementById('createRoleModal').close()" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">Cancel</button>
                    <button type="submit" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Create</button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- Edit Role Modal --}}
    <dialog id="editRoleModal" class="rounded-3xl p-0 backdrop:bg-slate-900/50 m-0 max-h-[90vh] overflow-y-auto z-50 w-[90vw] max-w-lg border-0">
        <div class="w-full max-w-lg p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Edit Role</h3>
            <form id="editRoleForm" method="POST">
                @csrf
                @method('PUT')
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Role Name</label>
                        <input type="text" name="name" id="editRoleName" required class="w-full rounded-2xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-300 focus:outline-none">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-3">Permissions</label>
                        <div class="space-y-3">
                            @foreach($allPermissions as $module => $perms)
                                <div class="border border-slate-100 rounded-xl p-3">
                                    <p class="font-semibold text-sm text-slate-700 mb-2 capitalize">{{ $module }}</p>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($perms as $perm)
                                            <label class="flex items-center gap-2 px-3 py-1 rounded-lg bg-slate-50 hover:bg-slate-100 cursor-pointer">
                                                <input type="checkbox" name="permissions[]" value="{{ $module }}.{{ $perm }}" class="rounded border-slate-300 edit-perm-{{ $module }}-{{ $perm }}">
                                                <span class="text-sm text-slate-600 capitalize">{{ $perm }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <label class="flex items-center gap-2 mt-4 px-3 py-2 rounded-lg bg-emerald-50 cursor-pointer">
                            <input type="checkbox" name="permissions[]" value="*" id="editRoleAllPerms" class="rounded border-slate-300" onchange="toggleAllPermissions(this)">
                            <span class="text-sm font-semibold text-emerald-700">Grant All Permissions (Super Admin)</span>
                        </label>
                    </div>
                </div>
                <div class="mt-6 flex gap-3 justify-end">
                    <button type="button" onclick="document.getElementById('editRoleModal').close()" class="rounded-2xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">Cancel</button>
                    <button type="submit" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Update</button>
                </div>
            </form>
        </div>
    </dialog>

    {{-- View Users by Role Modal --}}
    <dialog id="viewRoleUsersModal" class="rounded-3xl p-0 backdrop:bg-slate-900/50 m-0 max-h-[90vh] overflow-y-auto z-50 w-[90vw] max-w-lg border-0">
        <div class="w-full max-w-lg p-6">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Users with Role: <span id="viewRoleName"></span></h3>
            <div id="viewRoleUsersList" class="space-y-3 max-h-96 overflow-y-auto">
                {{-- Users will be loaded here --}}
            </div>
            <div class="mt-6 flex justify-end">
                <button type="button" onclick="document.getElementById('viewRoleUsersModal').close()" class="rounded-2xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Close</button>
            </div>
        </div>
    </dialog>

    <script>
        let deleteUserId = null;

        function editUser(id, name, email, roleId) {
            document.getElementById('editUserForm').action = '/app/users/' + id;
            document.getElementById('editUserName').value = name;
            document.getElementById('editUserEmail').value = email;
            document.getElementById('editUserRole').value = roleId || '';
            document.getElementById('editUserModal').showModal();
        }

        function openDeleteModal(id, name) {
            deleteUserId = id;
            document.getElementById('deleteUserName').textContent = name;
            document.getElementById('deleteUserForm').action = '/app/users/' + id;
            document.getElementById('deleteUserModal').showModal();
        }

        function editRole(id, name, permissions) {
            document.getElementById('editRoleForm').action = '/app/roles/' + id;
            document.getElementById('editRoleName').value = name;
            
            // Reset all checkboxes and enable them first
            document.querySelectorAll('#editRoleModal input[type="checkbox"]').forEach(cb => {
                cb.checked = false;
                cb.disabled = false;
            });
            
            // Set permissions
            const allPermsCheckbox = document.getElementById('editRoleAllPerms');
            if (permissions.includes('*')) {
                allPermsCheckbox.checked = true;
                // Disable other checkboxes when super admin is checked
                document.querySelectorAll('#editRoleModal input[name="permissions[]"]:not([value="*"])').forEach(cb => {
                    cb.disabled = true;
                });
            } else {
                permissions.forEach(perm => {
                    const parts = perm.split('.');
                    if (parts.length === 2) {
                        const cb = document.querySelector('.edit-perm-' + parts[0] + '-' + parts[1]);
                        if (cb) cb.checked = true;
                    }
                });
            }
            
            document.getElementById('editRoleModal').showModal();
        }

        function toggleAllPermissions(checkbox) {
            const container = checkbox.closest('form');
            const otherCheckboxes = container.querySelectorAll('input[name="permissions[]"]:not([value="*"])');
            otherCheckboxes.forEach(cb => {
                cb.disabled = checkbox.checked;
                cb.checked = false;
            });
        }

        function openDeleteRoleModal(id, name) {
            document.getElementById('deleteRoleName').textContent = name;
            document.getElementById('deleteRoleForm').action = '/app/roles/' + id;
            document.getElementById('deleteRoleModal').showModal();
        }

        async function showRoleUsers(roleId, roleName) {
            document.getElementById('viewRoleName').textContent = roleName;
            document.getElementById('viewRoleUsersList').innerHTML = '<p class="text-slate-500 text-center py-8">Loading...</p>';
            document.getElementById('viewRoleUsersModal').showModal();

            try {
                const response = await fetch('/app/roles/' + roleId + '/users');
                const data = await response.json();

                const container = document.getElementById('viewRoleUsersList');
                
                if (data.users.length === 0) {
                    container.innerHTML = '<p class="text-slate-500 text-center py-4">No users with this role.</p>';
                    return;
                }

                let html = '';
                data.users.forEach(user => {
                    html += `
                        <div class="flex items-center justify-between p-3 rounded-xl bg-slate-50 border border-slate-100">
                            <div>
                                <p class="font-semibold text-slate-900">${user.name}</p>
                                <p class="text-sm text-slate-500">${user.email}</p>
                            </div>
                            <span class="text-xs text-slate-400">${new Date(user.created_at).toLocaleDateString()}</span>
                        </div>
                    `;
                });
                container.innerHTML = html;
            } catch (error) {
                document.getElementById('viewRoleUsersList').innerHTML = '<p class="text-red-500 text-center py-4">Failed to load users.</p>';
            }
        }

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
