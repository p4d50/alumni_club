<x-dashboard-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
            <tr>
                <th scope="col" class="w-[48px] px-6 py-3">#</th>
                <th scope="col" class="px-6 py-3">Name</th>
                <th scope="col" class="px-6 py-3">Created at</th>
                <th scope="col" class="px-6 py-3"></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($unapproved as $u)
            <tr>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $u->id }}</td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $u->name }}</td>
                <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">{{ $u->created_at->diffForHumans() }}</td>
                <td><a class="text-blue-500 hover:underline" href="#">See Ticket</a></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</x-dashboard-layout>
