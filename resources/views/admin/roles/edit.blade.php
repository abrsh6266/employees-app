<x-admin-layout>
    <h1 class="text-2xl font-semibold p-4">Edit User</h1>
    <x-splade-form class="p-4 bg-white rounded-md space-y-2" :action="route('admin.users.update',$user)" method="PUT" :default="$user">
        <x-splade-input name="username" label="Username" />
        <x-splade-input name="first_name" label="First Name" />
        <x-splade-input name="last_name" label="Last Name" />
        <x-splade-input name="email" label="Email address" />

        <x-splade-submit />
    </x-splade-form>
</x-admin-layout>
