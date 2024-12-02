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

            @if($data->status_id != 2 && $data->status_id != 3)
                <a href="{{ route('admin-update', $data->id) }}"><button class="btn btn-primary">Редактировать</button></a>
            @else
                <!-- Если статус "Решена" или "Отклонена", кнопка не отображается -->
                <button class="btn btn-primary" disabled>Редактировать</button>
            @endif
            <a href="{{ route('admin-delete', $data->id)}}"><button class="btn btn-danger">Удалить</button></a>
        </div>
    </div>
</x-app-layout>