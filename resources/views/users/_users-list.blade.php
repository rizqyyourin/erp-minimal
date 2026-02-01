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
                <tr class="hover:bg-slate-50">
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
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-xs font-medium text-slate-700">
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
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('users.destroy', $user) }}" onsubmit="return confirm('Delete this user?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="p-2 text-slate-400 hover:text-red-600">
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
