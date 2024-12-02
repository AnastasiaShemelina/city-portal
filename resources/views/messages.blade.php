<!-- 
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{__('Заявки')}}
        </h2>
    </x-slot>
    <div class="mt-8">
        @foreach($data as $el)
        <div class="alert alert-info max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <h3>{{$el->subject}}</h3>
            <p>{{$el->email}}</p>
            <p><small>{{$el->created_at}}</small></p>
            <a href="{{route('contact-data-one', $el->id)}}"></a>
        </div>
        @endforeach
    </div>
    <div class="mt-8">
        @foreach($data as $el)
        <div class="alert alert-info max-w-7x1 mx-auto sm:px-6 lg:px-8">
            <h3>{{$el->subject}}</h3>
            <p>{{$el->email}}</p>
            <p><small>{{$el->created_at}}</small></p>
            <a href="{{route('contact-data-one', $el->id)}}"><button class="btn btn-warning">Подробнее</button></a>
        </div>
        @endforeach
    </div>
</x-app-layout> -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{__('Заявки')}}
        </h2>
    </x-slot>

    <div class="mt-8">
        @foreach($data as $el)
        <div class="alert alert-info max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h3>{{$el->subject}}</h3>
            <p>{{$el->email}}</p>
            <p><small>{{$el->created_at}}</small></p>
            
            <!-- Выводим категорию -->
            <p><strong>Категория:</strong> {{$el->category->name}}</p>

            <!-- Выводим статус -->
            <p><strong>Статус:</strong> {{$el->status->name}}</p>

            <a href="{{route('contact-data-one', $el->id)}}"><button class="btn btn-warning">Подробнее</button></a>
        </div>
        @endforeach
    </div>
</x-app-layout>
