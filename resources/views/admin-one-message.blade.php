<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            <strong>{{$data->subject}}</strong>
        </h2>
    </x-slot>
    <div class="mt-8 generalcontainerDiv">
        <div class="alert alert-info max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <p><strong>{{ $data->message}}</strong></p>
            <p>{{ $data->email}} - {{ $data->name }}</p>
            <p><small>{{ $data->created_at}}</small></p>

            <p>Статус заявки: <strong>{{ $data->status->name }}</strong></p> <!-- Статус как текст -->
            @if($data->status->name === 'Отклонена' && $data->rejection_reason)
                <p>Причина отклонения: {{ $data->rejection_reason }}</p>
            @endif

            <div class="photosOneCard">

                <!-- Проверяем статус и отображаем соответствующее фото -->
                @if($data->status->name === 'Новая')
                    @if($data->photo_before)
                        <img src="{{ asset('storage/' . $data->photo_before) }}" alt="Фото до"
                            class="h-[200px] w-[300px] object-cover rounded mr-5 mb-5 mt-5">
                    @else
                        <img src="{{ asset('storage/photos/default-photo.jpg') }}" alt="Фото не доступно"
                            class="h-[200px] w-[300px] object-cover rounded mr-5 mb-5 mt-5">
                    @endif
                @elseif($data->status->name === 'Решена')
                    @if($data->photo_before)
                        <img src="{{ asset('storage/' . $data->photo_before) }}" alt="Фото до"
                            class="h-[200px] w-[300px] object-cover rounded mr-5 mb-5 mt-5">
                    @else
                        <img src="{{ asset('storage/photos/default-photo.jpg') }}" alt="Фото не доступно"
                            class="h-[200px] w-[300px] object-cover rounded mr-5 mb-5 mt-5">
                    @endif
                    @if($data->photo_after)
                        <img src="{{ asset('storage/' . $data->photo_after) }}" alt="Фото после"
                            class="h-[200px] w-[300px] object-cover rounded mr-5 mb-5 mt-5">
                    @else
                        <img src="{{ asset('storage/photos/default-photo.jpg') }}" alt="Фото не доступно"
                            class="h-[200px] w-[300px] object-cover rounded mr-5 mb-5 mt-5">
                    @endif
                @endif

            </div>
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