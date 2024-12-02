<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{__('Редактирование заявки')}}
        </h2>
    </x-slot>
    <form action="{{route('admin-update-submit', $data->id)}}" class="max-w-7x1 mx-auto sm:px-6 lg:px-8 mt-8"
        method="post">
        @csrf

        <div class="form-group pt-2">
            <label for="status_id">Статус заявки</label>
            <select name="status_id" id="status_id" class="form-control">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" @if($data->status_id == $status->id) selected @endif
                        @if(in_array($status->id, [2, 3]) && !Auth::user()->isAdmin()) disabled @endif>
                        {{ $status->name }}
                    </option>
                @endforeach

            </select>
        </div>

        <div class="form-group pt-2">
            <label for="name">Имя</label>
            <input type="text" name="name" value="{{$data->name}}" placeholder="Your name" id="name"
                class="form-control">
        </div>

        <div class="form-group pt-2">
            <label for="name">Email</label>
            <input type="text" name="email" value="{{$data->email}}" placeholder="Your e-mail" id="email"
                class="form-control">
        </div>

        <div class="form-group pt-2">
            <label for="category_id">Категория</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($data->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group pt-2">
            <label for="subject">Тема заявки</label>
            <input type="text" name="subject" value="{{$data->subject}}" placeholder="Тема заявки" id="subject"
                class="form-control">
        </div>

        <div class="form-group pt-2">
            <label for="message">Текст заявки</label>
            <textarea type="text" name="message" placeholder="Текст заявки" id="message"
                class="form-control">{{$data->message}}</textarea>
        </div>
        <!-- Фото до отображается в любом случае -->
        @if($data->photo_before)
            <img src="{{ asset('storage/' . $data->photo_before) }}" alt="Фото до"
                class="w-[200px] object-cover rounded mr-5 mb-5 mt-5">
        @else
            <img src="{{ asset('storage/photos/default-photo.jpg') }}" alt="Фото не доступно"
                class="w-[200px] object-cover rounded mr-5 mb-5 mt-5">
        @endif

        <!-- Если статус заявки "Новая" -->
        @if($data->status->name === 'Новая')
            <input type="file" name="photo_after" id="photo_after" accept="image/*"
                class="file-input bg-gray-800 text-white border border-gray-600 rounded p-2 w-full mt-2">
        @endif

        <!-- Если статус заявки "Решена" -->
        @if($data->status->name === 'Решена')

            @if($data->photo_after)
                <!-- Если фото "после" уже загружено, отображаем его -->
                <img src="{{ asset('storage/' . $data->photo_after) }}" alt="Фото после" class="mt-2"
                    style="width: 200px; height: auto; display:block;">
            @else
                <!-- Если фото "после" не загружено, даем возможность загрузить новое фото -->
                <input type="file" name="photo_after" id="photo_after" accept="image/*"
                    class="file-input bg-gray-800 text-white border border-gray-600 rounded p-2 w-full mt-2">
            @endif
        @endif
        <input type="submit" class="btn btn-success mt-2" value="Обновить">
    </form>
</x-app-layout>
<script>
    function previewImage(event, previewId) {
        const file = event.target.files[0]; // Получаем файл из input
        const preview = document.getElementById(previewId); // Получаем элемент для отображения

        // Проверяем, что файл выбран
        if (file) {
            const reader = new FileReader(); // Создаем FileReader

            // Когда файл будет загружен, обновляем изображение
            reader.onload = function (e) {
                preview.src = e.target.result; // Обновляем src изображения
            };

            // Прочитаем файл как Data URL (что позволяет его отобразить)
            reader.readAsDataURL(file);
        } else {
            preview.src = ''; // Если файл не выбран, очищаем изображение
        }
    }


</script>