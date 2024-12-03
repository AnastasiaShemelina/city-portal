<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{__('Редактирование заявки')}}
        </h2>
    </x-slot>
    <form action="{{route('user-update-submit', $data->id)}}" class="max-w-7x1 mx-auto sm:px-6 lg:px-8 mt-8"
        method="post" enctype="multipart/form-data">
        @csrf

        <!-- Статус заявки (Текстовое поле, доступное только для просмотра) -->
        <div class="form-group text-gray-300 pt-2">
            <label for="status_id">Статус заявки</label>
            <p>{{ $data->status->name }}</p> <!-- Статус как текст -->
        </div>

        <div class="form-group text-gray-300 pt-2">
            <label for="name">Имя</label>
            <input type="text" name="name" value="{{$data->name}}" placeholder="Your name" id="name"
                class="form-control">
        </div>

        <div class="form-group text-gray-300 pt-2">
            <label for="name">Email</label>
            <input type="text" name="email" value="{{$data->email}}" placeholder="Your e-mail" id="email"
                class="form-control">
        </div>

        <div class="form-group text-gray-300 pt-2">
            <label for="category_id">Категория</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" @if($data->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group text-gray-300 pt-2">
            <label for="subject">Тема заявки</label>
            <input type="text" name="subject" value="{{$data->subject}}" placeholder="Тема заявки" id="subject"
                class="form-control">
        </div>

        <div class="form-group text-gray-300 pt-2">
            <label for="message">Текст заявки</label>
            <textarea type="text" name="message" placeholder="Текст заявки" id="message"
                class="form-control">{{$data->message}}</textarea>
        </div>

        @if($data->status->name === 'Новая')
            <input type="file" name="photo_before" id="photo_before" accept="image/*"
                onchange="previewImage(event, 'photo_before_preview')">

            <div id="photo_before_preview_container">
                <img id="photo_before_preview"
                    src="{{ $data->photo_before ? asset('storage/' . $data->photo_before) : '' }}" alt="Фото до"
                    class="mt-2" style="display:block; width: 200px; height: auto;">
            </div>
        @endif

        <!-- Фото после (если статус "Решена") -->
        @if($data->status->name === 'Решена')
            <label for="photo_after">Фото после</label>
            <img src="{{ asset('storage/' . $data->photo_after) }}" alt="Фото после" class="mt-2"
                style="display:block; width: 200px; height: auto;">
        @endif
        <button type="submit" class="btn btn-success mt-2">Обновить</button>

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
        reader.onload = function(e) {
            preview.src = e.target.result; // Обновляем src изображения
        };

        // Прочитаем файл как Data URL (что позволяет его отобразить)
        reader.readAsDataURL(file);
    } else {
        preview.src = ''; // Если файл не выбран, очищаем изображение
    }
}


</script>