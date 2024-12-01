<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{ __('Дашборд') }}
        </h2>
    </x-slot>
     <!-- Создаем контейнер для заявок -->
     <div class="mt-8">
        <!-- Используем flexbox для центрирования содержимого -->
        <div class="d-flex justify-content-center">
            <!-- Создаем контейнер для заявок с прокруткой на маленьких экранах -->
            <div class="row g-4 w-100 justify-content-center">
                @foreach($data as $el)
                    <div class="col-12 col-sm-6 col-md-4 col-lg-2">
                        <!-- Блок заявки с рамкой, скругленными углами и тенями -->
                        <div class="card h-100 border-0 shadow-sm rounded-3">
                            <div class="card-body">
                                <h5 class="card-title text-truncate">{{$el->subject}}</h5>
                                <p class="card-text text-truncate">{{$el->email}}</p>
                                <p class="card-text text-muted">
                                    <small>{{$el->created_at}}</small>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
</x-app-layout>
