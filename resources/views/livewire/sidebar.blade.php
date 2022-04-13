<div x-data="{admin: @entangle('admin')}" class="flex flex-col min-h-0 bg-gray-800 p-4">
  <div class="flex-1 flex flex-col pt-5 pb-4 overflow-y-auto">
    <div class="flex items-center flex-shrink-0 px-4">
      <img class="h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow">
    </div>
    <nav class="mt-5 flex-1 px-2 bg-gray-800 space-y-1 flex flex-col justify-between" aria-label="Sidebar">
      <div x-show="!admin" wire:key="mainMenu">
        @if (isset($mainMenu))
          @foreach ($mainMenu->items as $menuItem)
            <x-sidebar.link
              route="{{ $menuItem->route }}"
              label="{{ $menuItem->label }}">
              {!! $menuItem->icon !!}
            </x-sidebar.link>
          @endforeach
        @endif
      </div>
      @can('view admin menu')
        <div x-show="admin" wire:key="adminMenu">
          @if (isset($adminMenu))
            @foreach ($adminMenu->items as $menuItem)
              <x-sidebar.link
                route="{{ $menuItem->route }}"
                label="{{ $menuItem->label }}">
                {!! $menuItem->icon !!}
              </x-sidebar.link>
            @endforeach
          @endif
        </div>
      @endcan
    </nav>

    <div class="flex space-x-2 mx-auto items-center justify-between">
    <div class="flex items-center px-2 py-2 text-sm leading-5 font-medium focus:outline-none text-gray-300 hover:text-white space-x-2">
        <button @click="admin = !admin"
            type="button"
            class="relative inline-flex flex-shrink-0 h-6 w-11 border-2 border-transparent rounded-full cursor-pointer transition-colors ease-in-out duration-200 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" :class="{'bg-gray-200': !admin, 'bg-indigo-600': admin}" role="switch" aria-checked="false">
        <span class="sr-only">Admin menu</span>
        <span aria-hidden="true" class="pointer-events-none inline-block h-5 w-5 rounded-full bg-white shadow transform ring-0 transition ease-in-out duration-200" :class="{ 'translate-x-5': admin, 'translate-x-0': !admin}"></span>
        </button>
        <span>Admin</span>
    </div>
      <x-signout-button />
    </div>
  </div>

  <div class="flex-shrink-0 flex bg-gray-700 p-4 rounded-md">
    <a href="{{ route('profile.show') }}" class="flex-shrink-0 w-full group block">
      <div class="flex items-center">
        <div>
          <img class="h-9 w-9 rounded-full object-cover" src="{{ Auth::user()->profile_photo_url }}" alt="{{ Auth::user()->name }}" />
        </div>
        <div class="ml-3">
          <p class="text-sm font-medium text-white">{{ Auth::user()->name }}</p>
          <p class="text-xs font-medium text-gray-300 group-hover:text-gray-200">View profile</p>
        </div>
      </div>
    </a>
  </div>
</div>

