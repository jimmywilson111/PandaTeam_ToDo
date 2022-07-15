@component('mail::message')
    <h1>Task {{ $task->name }}, {{ $task->status ? 'completed' : 'unmark' }}</h1>

    {{ config('app.name') }}
@endcomponent
