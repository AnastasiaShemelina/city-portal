<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <strong>{{$data->subject}}</strong>
        </h2>
    </x-slot>
    <div class="mt-8">
        <div class="alert alert-info max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <p>Статус заявки: <strong>{{ $data->status->name }}</strong></p>
            <p>{{ $data->message}}</p>
            <p>{{ $data->email}}</p>
            <p><small>{{ $data->created_at}}</small></p>
        </div>
    </div>
</x-app-layout>