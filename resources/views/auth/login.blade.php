<x-guest-layout>
    @section('title', $page_title)
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="mx-auto h-16 w-auto" />
            </a>
            <h2 class="my-6 px-4 break-normal text-center text-3xl font-extrabold text-white">Sign in to your account</h2>
        </x-slot>

        <div class="bg-white py-4 md:py-8 px-4 md:py-10 shadow rounded sm:px-10">
            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- User Name -->
                <div>
                    <x-label for="name" :value="__('User Name')" />
                    <div class="mt-1">
                        <x-input id="name" class="appearance-none block w-full px-3 py-2 sm:text-sm" type="text" name="name" :value="old('name')"/>
                    </div>

                    @error('name')
                    <div class="mt-1 text-xs italic text-red-800">
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-label for="password" :value="__('Password')" />

                    <div class="mt-1 relative">
                        <x-input id="password" class="appearance-none block w-full px-3 py-2 sm:text-sm" type="password" name="password" autocomplete="current-password"/>
                        <i class="icon-toggler absolute inset-y-1/3 md:top-2.5 right-3 text-gray-500 far fa-eye"></i>
                    </div>

                    @error('password')
                    <div class="mt-1 text-xs italic text-red-800">
                        <span>{{ $message }}</span>
                    </div>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex flex-wrap items-center justify-between my-4">
                    <div class="flex items-center">
                        <input id="remember_me" name="remember" type="checkbox" class="h-4 w-4 text-red-500 focus:ring-red-600 border-gray-300 rounded">
                        <label for="remember_me" class="ml-2 block text-sm text-gray-900">
                            {{ __('Remember me') }}
                        </label>
                    </div>
                    @if (Route::has('password.request'))
                        <div class="text-sm">
                            <a href="{{ route('password.request') }}" class="font-medium text-red-500 hover:text-red-600 focus:ring-red-600">
                                {{ __('Forgot your password?') }}
                            </a>
                        </div>
                    @endif
                </div>

                <div>
                    <x-button>
                        {{ __('Log in') }}
                    </x-button>
                </div>
                <div>
                    <p class="text-center text-sm overflow-hidden before:h-[1px] after:h-[1px] after:bg-black after:inline-block after:relative after:align-middle after:w-1/4 before:bg-black before:inline-block before:relative before:align-middle before:w-1/4 before:right-2 after:left-2 p-4">
                        or
                    </p>
                    <a href="{{ ('register') }}" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-blue-500 hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 transition ease-in-out duration-150">
                        Sign Up
                    </a>
                </div>
            </form>
        </div>
    </x-auth-card>
</x-guest-layout>
<script>
    const iconToggler = document.querySelector('.icon-toggler');
    const password = document.querySelector('#password');

    if (password.value.length === 0) {
        iconToggler.classList.add('hidden');
    }

    password.addEventListener('input', (event) => {
        if (event.target.value > 0) {
            iconToggler.classList.remove('hidden');
        } else {
            iconToggler.classList.add('hidden');
        }
    });
    iconToggler.addEventListener('click', function () {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>
