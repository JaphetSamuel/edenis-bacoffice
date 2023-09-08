<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Profile Information') }}
        </h2>
    </header>

    <div class="mt-1 block w-full">
        Username: {{ $user->name }}
    </div>

    <div class="mt-1 block w-full">
        Email: {{ $user->email }}
    </div>

    <div class="mt-1 mr-1 block w-full">
        Sponsor link:
        <span class="bg-gray-100 rounded mr-2 px-1 py-1">
            {{ route('register', ['code' => $user->parrain_code]) }}
        </span>
        <button class="bg-gray-800 dark:bg-gray-200 rounded-md px-4 py-1 text-white dark:text-gray-100"
                onClick="navigator.clipboard.writeText(`{{ route('register', ['code' => $user->parrain_code]) }}`);;alert('copié')">
            {{ __('Copy') }}
        </button>
    </div>


</section>
