<div class="min-h-screen flex flex-col justify-center py-12 sm:px-6 lg:px-8" style="background-image:url({{ asset('/1.jpeg') }}); background-repeat:no-repeat; background-size: cover;">
    <div class="sm:mx-auto sm:w-full sm:max-w-md">
        {{ $logo }}
    </div>

    <div class="my-8 mx-4 sm:mx-auto sm:w-full sm:max-w-md">
        {{ $slot }}
    </div>
</div>
