<div x-data="{ open: false }">
    <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
        @forelse($roles as $role)
            <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-100">
                <div class="flex items-start justify-between mb-4">
                    <div>
                        <h3 class="text-lg font-semibold text-slate-900">{{ $role->name }}</h3>
                        <p class="text-sm text-slate-500">{{ $role->users_count }} users</p>
                    </div>
                    @if($role->name !== 'Admin')
                        <form method="POST" action="{{ route('roles.destroy', $role) }}" onsubmit="return confirm('Delete this role?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="p-2 text-slate-400 hover:text-red-600">
                                <i class="ph ph-trash text-lg"></i>
                            </button>
                        </form>
                    @endif
                </div>
                
                <div class="space-y-2">
                    <p class="text-xs font-semibold uppercase text-slate-400">Permissions:</p>
                    <div class="flex flex-wrap gap-1.5">
                        @forelse($role->permissions ?? [] as $permission)
                            <span class="rounded-full bg-slate-100 px-2.5 py-1 text-xs text-slate-600">{{ $permission }}</span>
                        @empty
                            <span class="text-sm text-slate-400">No permissions</span>
                        @endforelse
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center">
                <p class="text-slate-500">No roles configured yet.</p>
            </div>
        @endforelse
    </div>

    <div x-show="open" x-transition.opacity class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
        <div x-show="open" @click.outside="open = false" class="w-full max-w-md rounded-2xl bg-white p-6 shadow-xl">
            <h3 class="text-lg font-semibold text-slate-900 mb-4">Create New Role</h3>
            <form method="POST" action="{{ route('roles.store') }}">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Role Name</label>
                        <input type="text" name="name" required class="w-full rounded-xl border border-slate-200 px-4 py-2 text-sm focus:border-slate-400 focus:outline-none" placeholder="e.g., Supervisor">
                    </div>
                    <div>
                        <label class="block text-sm font-medium text-slate-700 mb-1">Permissions</label>
                        <div class="space-y-2 max-h-48 overflow-y-auto border border-slate-200 rounded-xl p-3">
                            @foreach($allPermissions as $category => $perms)
                                @foreach($perms as $perm)
                                    <label class="flex items-center gap-2">
                                        <input type="checkbox" name="permissions[]" value="{{ $category . '.' . $perm }}" class="rounded border-slate-300 text-slate-900 focus:ring-slate-500">
                                        <span class="text-sm text-slate-600">{{ $category . '.' . $perm }}</span>
                                    </label>
                                @endforeach
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="mt-6 flex justify-end gap-3">
                    <button type="button" x-on:click="open = false" class="rounded-xl border border-slate-200 px-4 py-2 text-sm font-semibold text-slate-700 hover:border-slate-300">Cancel</button>
                    <button type="submit" class="rounded-xl bg-slate-900 px-4 py-2 text-sm font-semibold text-white hover:bg-slate-800">Create Role</button>
                </div>
            </form>
        </div>
    </div>
</div>
