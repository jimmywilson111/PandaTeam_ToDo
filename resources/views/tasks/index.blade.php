<x-app-layout>
    @section('title', $page_title)
    <div class="md:mx-2 p-4 bg-white shadow-sm rounded-lg border-b border-gray-200">
        <h1 class="font-bold text-xl md:text-2xl">{{ __('Task List') }}</h1>
    </div>
    <x-flash-message/>
    <div class="md:mx-2 mt-4 p-4 bg-white shadow-sm rounded-lg border-b border-gray-200">
        <!-- BEGIN: Form Layout -->
        <form action="{{ route('tasks.store') }}" METHOD="POST" class="flex flex-wrap md:flex-nowrap">
            @csrf
            <div class="w-full md:w-1/2 lg:w-1/3 mb-4 md:mb-0 md:mr-4">
                <x-label for="name"></x-label>
                <x-input class="appearance-none w-full px-3 py-2 sm:text-sm placeholder:italic " type="text" name="name" :value="old('name')" placeholder="Enter task name..."></x-input>
                @error('name')
                <div class="mt-1 text-xs italic text-red-800">
                    <span>{{ $message }}</span>
                </div>
                @enderror
            </div>
            <div>
                <x-button class="md:w-48">{{ __('Create Task') }}</x-button>
            </div>
        </form>
    </div>
    <div class="md:mx-2 my-4 col-span-12 overflow-auto">
        @if($task_list->isNotEmpty())
            <table class="table-report table-auto border-separate lg:-mt-2 w-full text-left">
                <thead>
                    <tr class="uppercase">
                        <th class="whitespace-nowrap">{{ __('Id') }}</th>
                        <th class="whitespace-nowrap">{{ __('Name') }}</th>
                        <th class="whitespace-nowrap">{{ __('Actions') }}</th>
                    </tr>
                </thead>
                @foreach($task_list as $item)
                    <tbody>
                        <tr class="relative">
                            <td class="w-20 {{ $item->status ? 'line-through' : '' }}"> {{ $item->id }}</td>
                            <td class="whitespace-nowrap {{ $item->status ? 'line-through' : '' }}"> {{ $item->name }}</td>
                            <td class="w-40">
                                <form action="{{ route('tasks.update', $item->id) }}" method="POST">
                                    @method('PATCH')
                                    @csrf
                                    @if($item->status)
                                        <input type="hidden" value="0" name="status"/>
                                        <button type="submit" class="flex items-center justify-center whitespace-nowrap">
                                            <svg class="text-[#91C714] mr-1" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 50 50">
                                                <path d="M 11 4 C 7.1545455 4 4 7.1545455 4 11 L 4 39 C 4 42.845455 7.1545455 46 11 46 L 39 46 C 42.845455 46 46 42.845455 46 39 L 46 11 C 46 7.1545455 42.845455 4 39 4 L 11 4 z M 11 6 L 39 6 C 41.754545 6 44 8.2454545 44 11 L 44 39 C 44 41.754545 41.754545 44 39 44 L 11 44 C 8.2454545 44 6 41.754545 6 39 L 6 11 C 6 8.2454545 8.2454545 6 11 6 z M 12 22 L 12 23 L 12 28 L 38 28 L 38 22 L 12 22 z M 14 24 L 36 24 L 36 26 L 14 26 L 14 24 z" font-weight="400" font-family="sans-serif" white-space="normal" overflow="visible"/>
                                            </svg>
                                            {{ __('Unmark') }}
                                        </button>
                                    @else
                                        <input type="hidden" value="1" name="status"/>
                                        <button class="flex items-center justify-center whitespace-nowrap text-[#91C714]">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                 stroke-linejoin="round" class="feather feather-check-square w-4 h-4 mr-2">
                                                <polyline points="9 11 12 14 22 4"></polyline>
                                                <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"></path>
                                            </svg>
                                            {{ __('Mark as done') }}
                                        </button>
                                    @endif
                                </form>
                            </td>
                            <td class="relative w-56">
                                <div class="{{ $item->status ? '' : 'hidden' }}">
                                    <form id="delete-{{ $item->id }}" action="{{ route('tasks.destroy', $item->id) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                        <a role="button" class="flex items-center text-red-600 hover:text-red-800" href="javascript:void(0)" data-modal-toggle="popup-modal-{{ $item->id }}">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                                 fill="none" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                                                 stroke-linejoin="round" class="feather feather-trash-2 w-4 h-4 mr-1">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path
                                                    d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg> {{ __('Delete') }}
                                        </a>
                                    </form>
                                </div>
                                <div id="popup-modal-{{ $item->id }}" tabindex="-1" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 md:inset-0 h-modal md:h-full">
                                    <div class="relative p-4 w-full max-w-md h-full md:h-auto">
                                        <div class="relative bg-white rounded-lg shadow">
                                            <button type="button" class="absolute top-3 right-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center" data-modal-toggle="popup-modal-{{ $item->id }}">
                                                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                                            </button>
                                            <div class="p-6 text-center">
                                                <svg class="mx-auto mb-4 w-14 h-14 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                                <h3 class="mb-5 text-lg font-normal text-gray-500">{{ __('Are you sure you want to delete this task?') }}</h3>
                                                <button data-modal-toggle="popup-modal-{{ $item->id }}" type="button" class="text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center mr-2" onclick="document.querySelector('#delete-{{ $item->id }}').submit()">
                                                    {{ __('Yes, I am sure') }}
                                                </button>
                                                <button data-modal-toggle="popup-modal-{{ $item->id }}" type="button" class="text-gray-500 bg-white hover:bg-gray-100 focus:ring-4 focus:outline-none focus:ring-gray-200 rounded-lg border border-gray-200 text-sm font-medium px-5 py-2.5 hover:text-gray-900 focus:z-10">{{ __('No, cancel') }}</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                @endforeach
            </table>
        @else
            <div class="p-4 bg-white shadow-sm rounded-lg border-b border-gray-200">
                <h1 class="page-title font-bold text-xl">{{ __('No items found') }}</h1>
            </div>
        @endif
    </div>
</x-app-layout>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('5e2ef01ed7245f1dc849', {
            cluster: 'eu'
        });

        var channel = pusher.subscribe('task_list');
        channel.bind('my-event', function(data) {
            console.log(data)
        });
    });
</script>
