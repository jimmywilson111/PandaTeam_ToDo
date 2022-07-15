<x-guest-layout>
    @section('title', $page_title)
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="mx-auto h-16 w-auto" />
            </a>
            <h2 class="my-6 px-4 break-normal text-center text-3xl font-extrabold text-white">Register New User</h2>
        </x-slot>

        <div class="bg-white py-4 md:py-8 px-4 md:py-10 shadow rounded sm:px-10">
            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Name -->
                <div>
                    <x-label for="name" :value="__('Name')" />

                    <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')"/>
                    @error('name')
                    <div class="mt-1 text-xs italic text-red-800">
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Email Address -->
                <div class="mt-4">
                    <x-label for="email" :value="__('Email')" />

                    <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" />
                    @error('email')
                    <div class="mt-1 text-xs italic text-red-800">
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <x-input id="password" class="block mt-1 w-full"
                             type="password"
                             name="password"/>
                    @error('password')
                    <div class="mt-1 text-xs italic text-red-800">
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-label for="password_confirmation" :value="__('Confirm Password')" />

                    <x-input id="password_confirmation" class="block mt-1 w-full"
                             type="password"
                             name="password_confirmation" />
                    @error('password_confirmation')
                    <div class="mt-1 text-xs italic text-red-800">
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <div class="flex flex-wrap items-center justify-between my-4">
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                        {{ __('Already registered?') }}
                    </a>
                    <div>
                        <x-button>
                            {{ __('Register') }}
                        </x-button>
                    </div>
                </div>


            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
