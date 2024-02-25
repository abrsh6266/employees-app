<x-admin-layout>
    <h1 class="text-2xl font-semibold p-4">New Country</h1>
    <x-splade-form class="p-4 bg-white rounded-md space-y-2" :action="route('admin.countries.store')" method="POST" >
        <x-splade-input name="name" label="Country Name" />
        <x-splade-input name="country_code" label="Country Code" />
        <x-splade-submit />
    </x-splade-form>
</x-admin-layout>
