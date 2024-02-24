<x-admin-layout>
    <h1>Users index</h1>
    <x-splade-table :for="$users">
        @cell('action', $user)
            <Link href="{{ route('admin.users.edit', $user) }}" class="px-3 p-2 bg-green-400 texet-white hover:bg-green-700 rounded">Edit
            </Link>
        @endcell
    </x-splade-table>
</x-admin-layout>
