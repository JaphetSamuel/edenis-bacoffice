<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('KYC form') }}
        </h2>
        <form action="{{ route('kyc.store') }}" method="post">
            @csrf
            @method('post')
                <div class="mt-4">
                    <x-input-label for="name" :value="__('First Name')" />
                    <x-text-input id="name" name="nom" type="text" class="mt-1 block w-full"  required autofocus autocomplete="nom" />
                    <x-input-error class="mt-2" :messages="$errors->get('name')" />
                </div>

                <!-- lastname -->
                <div class="mt-4">
                    <x-input-label for="lastname" :value="__('Last Name')" />
                    <x-text-input id="lastname" name="prenom" type="text" class="mt-1 block w-full" required autofocus autocomplete="prenom" />
                    <x-input-error class="mt-2" :messages="$errors->get('prenom')" />
                </div>

                <!-- adresse -->
            <div class="mt-4">
                <x-input-label for="adresse" :value="__('Adresse')" />
                <x-text-input id="adresse" name="adresse" type="text" class="mt-1 block w-full" required autofocus autocomplete="adresse" />
                <x-input-error class="mt-2" :messages="$errors->get('adresse')" />
            </div>

            <!-- ville -->
            <div class="mt-4">
                <x-input-label for="ville" :value="__('Ville')" />
                <x-text-input id="ville" name="ville" type="text" class="mt-1 block w-full" required autofocus autocomplete="ville" />
                <x-input-error class="mt-2" :messages="$errors->get('ville')" />
            </div>

            <!-- pays :make the same input for pay -->

            <div class="mt-4">
                <x-input-label for="pays" :value="__('Residence country')" />
                <x-select-input  id="pays" name="pays" type="text" class="mt-1 block w-full" required autofocus autocomplete="ville" />
                <x-input-error class="mt-2" :messages="$errors->get('ville')" />
            </div>

            <!-- Lieu naissance -->
            <div class="mt-4">
                <x-input-label for="lieu_naissance" :value="__('lieu_naissance')" />
                <x-text-input id="lieu_naissance" name="lieu_naissance" type="text" class="mt-1 block w-full" required autofocus autocomplete="lieu_naissance" />
                <x-input-error class="mt-2" :messages="$errors->get('lieu_naissance')" />
            </div>

            <!-- date naissance -->
            <div class="mt-4">
                <x-input-label for="date_naissance" :value="__('birthday')" />
                <x-text-input id="date_naissance" name="lieu_naissance" type="date" class="mt-1 block w-full" required autofocus autocomplete="date_naissance" />
                <x-input-error class="mt-2" :messages="$errors->get('date_naissance')" />
            </div>

            <!-- nationalite -->
            <div class="mt-4">
                <x-input-label for="nationalite" :value="__('nationality')" />
                <x-text-input id="nationalite" name="nationalite" type="text" class="mt-1 block w-full" required autofocus autocomplete="nationalite" />
                <x-input-error class="mt-2" :messages="$errors->get('nationalite')" />
            </div>

            <!-- profession -->
            <div class="mt-4">
                <x-input-label for="profession" :value="__('profession')" />
                <x-text-input id="profession" name="profession" type="text" class="mt-1 block w-full" required autofocus autocomplete="profession" />
                <x-input-error class="mt-2" :messages="$errors->get('profession')" />
            </div>

            <!-- type de piece -->
            <div class="mt-4">
                <x-input-label for="type_piece" :value="__('document type')" />
                <x-text-input id="type_piece" name="type_piece" type="text" class="mt-1 block w-full" required autofocus autocomplete="type_piece" />
                <x-input-error class="mt-2" :messages="$errors->get('type_piece')" />
            </div>

            <!-- piece -->
            <div class="mt-4">
                <x-input-label for="piece_identite" :value="__('document')" />
                <x-text-input id="piece_identite" name="piece_identite" type="file" class="mt-1 block w-full" required autofocus autocomplete="piece_identite" />
                <x-input-error class="mt-2" :messages="$errors->get('piece_identite')" />
            </div>

            <!-- piece -->
            <div class="mt-4">
                <x-input-label for="numero_piece_identite" :value="__('document')" />
                <x-text-input id="numero_piece_identite" name="numero_piece_identite" type="text" class="mt-1 block w-full" required autofocus autocomplete="numero_piece_identite" />
                <x-input-error class="mt-2" :messages="$errors->get('numero_piece_identite')" />
            </div>



        </form>
    </header>


</section>
