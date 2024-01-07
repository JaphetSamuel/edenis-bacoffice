<section>
    <header>
        <h2 class="text-lg font-medium text-primary text-bold">
            {{ __('Profil Informations') }}
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
        <button class=" bg-primary rounded px-4 py-1 text-gray-dark dark:text-gray-100"
                onClick="navigator.clipboard.writeText(`{{ route('register', ['code' => $user->parrain_code]) }}`);;alert('copied')">
            {{ __('Copy') }}
        </button>
    </div>


</section>
