<nav x-data="{ open: false }" class="bg-gray-100 p-4 border-2 border-gray-300 rounded-full shadow-md mx-4 mt-6">
    <!-- Primary Navigation Menu -->
    <div class="container mx-auto flex justify-between items-center">
        <!-- Logo -->
        <div class="flex items-center">
            <a href="{{ route('dashboard') }}">
                <img src="https://kgeu.ru/local/static/img/logo--blue.svg" alt="University Logo" class="h-10 mr-3">
                <span class="text-gray-900 text-xl font-bold">Dorm Management</span>
            </a>
        </div>

        <!-- Navigation Links -->
         <div class="flex-grow flex justify-center space-x-6">
            <!-- <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-900 font-semibold text-xl hover:bg-blue-600 hover:text-white px-6 py-3 rounded-md transition-all duration-300">
                {{ __('Dashboard') }}
            </x-nav-link>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-900 font-semibold text-xl hover:bg-blue-600 hover:text-white px-6 py-3 rounded-md transition-all duration-300">
                {{ __('Rooms Cleaned') }}
            </x-nav-link>
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-900 font-semibold text-xl hover:bg-blue-600 hover:text-white px-6 py-3 rounded-md transition-all duration-300">
                {{ __('Unclean Rooms') }}
            </x-nav-link>
            @if(Auth::user()->hasRole('building_manager'))
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')" class="text-gray-900 font-semibold text-xl hover:bg-blue-600 hover:text-white px-6 py-3 rounded-md transition-all duration-300">
                {{ __('Important Notices') }}
            </x-nav-link>
            @endif -->
            <x-nav-link :href="route('buildings.index')" :active="request()->routeIs('dashboard')" role="director" text="Dashboard" />
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('rooms.cleaned')" role="director" text="Rooms Cleaned" />
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('rooms.uncleaned')" role="director" text="Unclean Rooms" />
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('notices')" role="director" text="Important Notices" />

            <x-nav-link :href="route('floors.index')" :active="request()->routeIs('dashboard')" role="building_manager" text="Dashboard" />
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('rooms.cleaned')" role="building_manager" text="Rooms Cleaned" />
            <x-nav-link :href="route('dashboard')" :active="request()->routeIs('rooms.uncleaned')" role="building_manager" text="Unclean Rooms" />


            <x-nav-link :href="route('assignmentreviews.index')" :active="request()->routeIs('notices')" role="floor_manager" text="Assignments" />
            <x-nav-link :href="route('rooms.index')" :active="request()->routeIs('notices')" role="floor_manager" text="Rooms" />


            <!-- Add other links here similarly -->
        </div>
        <div class="flex">

        <!-- Settings Dropdown -->
        <div class="hidden sm:flex sm:items-center sm:ms-6">
            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                        <div>{{ Auth::user()->name }}</div>

                        <div class="ms-1">
                            <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </div>
                    </button>
                </x-slot>

                <x-slot name="content">

                <x-dropdown-link href="{{ route('rooms.create') }}"  role="floor_manager" text="Add Room" />
                <x-dropdown-link href="{{ route('rooms.assign-students.form') }}"  role="floor_manager" text="Register Student" />

                <a href="{{ route('profile.edit') }}" class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                  {{ __('Profile') }}
                </a>
                    <!-- Authentication -->
                    <form method="POST" action="{{ route('logout') }}" class="block w-full">
                     @csrf
                      <button type="submit" class="block w-full px-4 py-2 text-start text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
                     {{ __('Logout') }}
                      </button>
                    </form>
                </x-slot>
            </x-dropdown>
        </div>

        <!-- Hamburger -->
        <div class="-me-2 flex items-center sm:hidden">
            <button @click="open = ! open" class="inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 focus:text-gray-500 transition duration-150 ease-in-out">
                <svg class="h-6 w-6" stroke="currentColor" fill="none" viewBox="0 0 24 24">
                    <path :class="{'hidden': open, 'inline-flex': ! open }" class="inline-flex" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                    <path :class="{'hidden': ! open, 'inline-flex': open }" class="hidden" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </button>
        </div>
    </div>

    <!-- Responsive Navigation Menu -->
    <div :class="{'block': open, 'hidden': ! open}" class="hidden sm:hidden">
        <div class="pt-2 pb-3 space-y-1">
            <x-responsive-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                {{ __('Dashboard') }}
            </x-responsive-nav-link>
        </div>

        <!-- Responsive Settings Options -->
        <div class="pt-4 pb-1 border-t border-gray-200">
            <div class="px-4">
                <div class="font-medium text-base text-gray-800">{{ Auth::user()->name }}</div>
                <div class="font-medium text-sm text-gray-500">{{ Auth::user()->email }}</div>
            </div>

            <div class="mt-3 space-y-1">
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                            onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
