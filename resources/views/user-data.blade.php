<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{__('Ваши заявки')}}
        </h2>
    </x-slot>

    <div class="mt-8 generalcontainerDiv">
        @foreach($data as $el)

            <div class="general-container">
                <div class="image-container">
                    <!-- Проверяем статус и отображаем соответствующее фото -->
                    @if($el->status->name === 'Решена' && $el->photo_after)
                        <img src="{{ asset('storage/' . $el->photo_after) }}" alt="Фото после"
                            class="h-[200px] w-[300px] object-cover rounded-l">
                    @elseif($el->status->name === 'Новая' && $el->photo_before)
                        <img src="{{ asset('storage/' . $el->photo_before) }}" alt="Фото до"
                            class="h-[200px] object-cover rounded-l">
                    @else
                        <img src="{{ asset('storage/photos/default-photo.jpg') }}" alt="Фото не доступно"
                            class="h-[200px] w-[300px] object-cover rounded-l">
                    @endif
                </div>
                <div class="alert-info rounded-r h-[200px] w-[500px]">
                    <div class="myCardRequest">
                        <div class="info-container">
                            <h3><strong>{{$el->subject}}</strong></h3>
                            <p>{{$el->email}}</p>
                            <p>Категория: {{$el->category->name}}</p>
                            <p>Статус: <strong>{{$el->status->name}}</strong></p>
                            <p><small>{{$el->created_at}}</small></p>
                            <a href="{{route('user-data-one', $el->id)}}"><button
                                    class="btn btn-warning">Подробнее</button></a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</x-app-layout>