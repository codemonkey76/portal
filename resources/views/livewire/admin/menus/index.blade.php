<div class="px-4 sm:px-6 lg:px-8">
  <div class="sm:flex sm:items-center">
    <div class="sm:flex-auto">
      <h1 class="text-xl font-semibold text-gray-900">Menus</h1>
      <p class="mt-2 text-sm text-gray-700">List of menus for both users and admins.</p>
    </div>
  </div>

  <div class="divide-y divide-gray-300 space-y-8 flex flex-col">
    @livewire('admin.menus.admin')
    @livewire('admin.menus.main')
  </div>
</div>
