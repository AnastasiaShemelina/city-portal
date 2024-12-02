<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{__('Заявки пользователей')}}
        </h2>
    </x-slot>
    <div class="mt-8">
        @foreach($data as $el)
        <div class="alert alert-info max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <h3><strong>{{$el->subject}}</strong></h3>
            <p>{{$el->email}}</p>
            <p>Категория: {{$el->category->name}}</p>
            <p>Статус: <strong>{{$el->status->name}}</strong></p>
            <p><small>{{$el->created_at}}</small></p>
            <a href="{{route('admin-data-one', $el->id)}}"><button class="btn btn-warning">Подробнее</button></a>
        </div>
        @endforeach
    </div>
</x-app-layout>