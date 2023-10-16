<x-guest-layout>
        <form class="w-full grid md:grid-cols-2 gap-4 " method="POST" action="{{ route('register') }}">
            @csrf

            <div class="sm:col-span-2 items-center">
                <span class="text-white font-extrabold text-4xl">Signup</span>
            </div>

            <div class="h-4 col-span-2"></div>

            <!-- Name -->
            <div>
                <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required
                              autofocus autocomplete="name"
                              placeholder="Firstname"  />
                <x-input-error :messages="$errors->get('name')" class="mt-2"/>
            </div>

            <!-- LastName -->
            <div>
                <x-text-input id="lastname" class="block mt-1 w-full" type="text" name="lastname" :value="old('lastname')"
                              required autofocus autocomplete="lastname" placeholder="Lastname" />
                <x-input-error :messages="$errors->get('lastname')" class="mt-2"/>
            </div>

            <!-- Email Address -->
            <div class="mt-4 md:col-span-2">
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required
                              autocomplete="username" placeholder="Email"/>
                <x-input-error :messages="$errors->get('email')" class="mt-2"/>
            </div>

            <!-- Phone -->
            <div class="mt-4">
                <x-text-input id="phone" class="block mt-1 w-full" type="tel" name="phone" :value="old('phone')" required
                placeholder="Phone"/>
                <x-input-error :messages="$errors->get('phone')" class="mt-2"/>
            </div>
            <div></div>

            <!-- Password -->
            <div class="mt-4 col-span-2">

                <x-text-input id="password" class="block mt-1 w-full"
                              type="password"
                              name="password"
                              placeholder="Password"
                              required autocomplete="new-password"/>

                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
            </div>

            <!-- Confirm Password -->
            <div class="mt-4 col-span-2">

                <x-text-input id="password_confirmation" class="block mt-1 w-full"
                              type="password"
                              placeholder="Confirm Password"
                              name="password_confirmation" required autocomplete="new-password"/>

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
            </div>

            <!-- Sponsor Code -->
            <div class="mt-4 col-span-2">
                <x-text-input id="code" class="block mt-1 w-full" type="text" name="code" :value="$code" readonly
                placeholder="Sponsor Code"/>
                <x-input-error :messages="$errors->get('code')" class="mt-2"/>
            </div>

            <!-- Terms -->
            <div class="mt-4 col-span-2 flex">
                <x-checkbox-input type="checkbox" id="terms" class="block mt-1" type="checkbox" name="terms" :value="old('terms')" required
                placeholder="Terms"/>
                <label for="terms" class="ml-2 tex-xl"> By registering, you agree that you have read, understand, and acknowledge our
                    <a href="#" class="font-bold underline">Privacy Policy</a> and accept our <a href="#"class="font-bold underline">General Terms of Use</a>.</label>
                <x-input-error :messages="$errors->get('terms')" class="mt-2"/>
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-white dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800"
                   href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-primary-button class="ml-4 bg-primary text-xl" style="width: 200px!important; color: #1a202c !important; text-align: center">
                    {{ __('Register') }}
                </x-primary-button>
            </div>
        </form>
</x-guest-layout>

