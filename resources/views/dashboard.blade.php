<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
        <div class="flex justify-end h-32 w-32">
            <x-primary-button >
                <a href="{{route('packs.create')}}">
                    {{ __('Buy packs') }}
                </a>
            </x-primary-button>
        </div>

    </x-slot>
    <marquee behavior="" direction="">Informations that will always be display</marquee>

    <div class="py-12 flex">
        <div class=" flex-1 max-w-7xl mx-auto sm:px-6 lg:px-8 h-32">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex py-6 px-6 items-center">
                    <img src="srf" class="mr-4">
                    <div>
                        <strong>{{$user->portefeuille->solde}}</strong>
                        <i> USD</i>
                        <br>
                        <span> Balance </span>
                    </div>
                </div>
            </div>
        </div>
        <div class=" flex-1 max-w-7xl mx-auto sm:px-6 lg:px-8 h-32">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="flex py-6 px-6 items-center" >
                    <img src="srf">
                    <div>
                        <strong>{{$user->portefeuille->titres}}</strong>
                        <br>
                        <span> Number of packs </span>
                    </div>
                </div>
            </div>
        </div>
        <div class=" flex-1 max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
