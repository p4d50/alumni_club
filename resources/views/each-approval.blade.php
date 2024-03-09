<x-dashboard-layout>
  <x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
      {{ $user->name }}'s Approval
    </h2>
  </x-slot>

  <div class="p-4">
    <span>
      <a class="text-blue-500 hover:underline" href="/dashboard/approvals">Back</a>
      {{ $user->name }}'s Approval
    </span>

    @if ($user->hasApprovalDocument())
      <img src="http://localhost:8000/storage{{ $user->approvalDocument->path_to_document }}" alt="asd" class="w-full">
    @endif
    
    <a class="inline-block px-4 py-2 bg-blue-500 text-white rounded-md" href="/dashboard/approvals/{{ $user->id }}/approve">Approve</a>
  </div>
</x-dashboard-layout>