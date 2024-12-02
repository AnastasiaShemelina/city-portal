<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            <strong>{{$data->subject}}</strong>
        </h2>
    </x-slot>
    <div class="mt-8">
        <div class="alert alert-info max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <p>{{ $data->message}}</p>
            <p>{{ $data->email}} - {{ $data ->name }}</p>
            <p><small>{{ $data->created_at}}</small></p>

            <p>Статус заявки: <strong>{{ $data->status->name }}</strong></p> <!-- Статус как текст -->

            <a href="{{ route('user-update', $data->id)}}"><button class="btn btn-primary">Редактировать</button></a>
            <a href="{{ route('user-delete', $data->id)}}"><button class="btn btn-danger">Удалить</button></a>
        </div>
    </div>
</x-app-layout>