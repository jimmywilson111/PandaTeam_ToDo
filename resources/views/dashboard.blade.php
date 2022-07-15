<x-app-layout>
    @section('title', $page_title)
    <div class="md:mx-2 p-4 bg-white shadow-sm rounded-lg border-b border-gray-200">
        <h1 class="font-bold text-xl md:text-2xl">{{ __('Dashboard') }}</h1>
    </div>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
