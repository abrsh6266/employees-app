<x-admin-layout>
    <div class="flex justify-between">
        <h1 class="text-2xl font-semibold p-4">Departments index</h1>
        <div class="p-4">
            <Link href="{{ route('admin.departments.create') }}"
                class="px-4 py-2 bg-indigo-500 hover:bg-indigo-700 rounded text-white">New Department</Link>
        </div>
    </div>
    <x-splade-table :for="$departments">
        @cell('action', $department)
            <div class="space-x-2">
                <Link href="{{ route('admin.departments.edit', $department) }}"
                    class="px-3 p-2 bg-green-400 texet-white hover:bg-green-700 rounded">Edit
                </Link>
                <Link href="{{ route('admin.departments.destroy', $department) }}" method="DELETE" confirm="Delete the department"
                    confirm-text="Are you sure?" confirm-button="Yes!" cancel-button="No"
                    class="px-3 p-2 bg-red-400 texet-white hover:bg-red-700 rounded">Delete
                </Link>
            </div>
        @endcell
    </x-splade-table>
</x-admin-layout>
