
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            Not approved
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    @if (auth()->user()->hasApprovalDocument())
                        <span>You are currently unapproved, wait until administrator let you in.</span>
                    @else
                        <form>
                            <div class="mb-6">
                                <select name="type" class="block">
                                    <option value="index">Index</option>
                                    <option value="diploma">Diploma</option>
                                </select>
                            </div>
                            <div class="mb-6">
                                <input type="file" name="file">
                            </div>
                            <button type="submit" class="block px-3 py-2 bg-blue-500 text-white cursor-pointer">Submit Approval</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
