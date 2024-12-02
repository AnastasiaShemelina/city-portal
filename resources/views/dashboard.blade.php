<style>
    .general {
        display: flex;
        justify-content: space-between;
        /* Размещение слогана и карточек с отступом */
        align-items: center;
        /* Центрируем элементы по вертикали */
        min-height: 70vh;
        padding-left: 8%; /* Увеличиваем отступ слева */
        padding-right: 7%; /* Увеличиваем отступ справа */
    }

    /* Слоган */
    .slogan-container {
        display: flex;
        align-items: center;
        justify-content: center;
        /* Центрируем слоган по горизонтали */
        height: 100%;
        /* Используем всю высоту */
        text-align: center;
        font-size: 5rem;
        /* Очень большой шрифт */
        font-weight: bold;
        text-transform: uppercase;
    }

    .slogan {
        margin-top: 0;
    }


    /* Контейнер для карточек */
    .card-container {
        display: flex;
        flex-direction: column;
        justify-content: flex-start;
        height: 100%;
    }


    .card-container .card {
        background-color: #212529 !important;
        /* Темный фон для карточек */
        border-radius: 0.375rem;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
        /* Отступ между карточками */
    }

    .card-title {
        font-size: 1.125rem;
        font-weight: 600;
        color: #f3f4f6 !important;
        /* Светлый текст */
    }

    .card-text {
        color: #e5e7eb !important;
        /* Светлый текст */
    }

    .card-footer {
        font-size: 0.8rem;
        color: #bbb !important;
    }
</style>


<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{ __('Дашборд') }}
        </h2>
    </x-slot>

    <!-- Основной контент -->
    <div class="container mt-8"> <!-- Добавили класс container для отступов по бокам -->

        <div class="general d-flex justify-content-between align-items-center">

            <!-- Слоган -->
            <div class="slogan-container">
                <div class="slogan">СДЕЛАЕМ ЛУЧШЕ <br> ВМЕСТЕ</div>
            </div>

            <!-- Контейнер для карточек -->
            <div class="card-container">
                @foreach($data as $el)
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title text-truncate">{{$el->subject}}</h5>
                            <p class="card-text text-truncate">{{$el->email}}</p>
                            <p class="card-text text-truncate">Категория: {{$el->category->name}}</p>
                        </div>
                        <div class="card-footer ">
                            <small>{{$el->created_at}}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>

</x-app-layout>