<x-app-layout>
    <x-slot name="header" class="dark:bg-gray-200">
        <h2 class="font-semibold text-xl dark:text-gray-300 leading-tight ">
            {{ __('Новая заявка') }}
        </h2>
    </x-slot>



    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=" bg-gray-100 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-300">
                    Заполните форму
                </div>
            </div>
        </div>
    </div>

    <form action="{{ route('contact-form')}}" class="max-w-7xl mx-auto sm:px-6 lg:px-8" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="dark:text-gray-800">
            <div class="form-group text-gray-300 mt-2">
                <label for="status">Статус заявки</label>
                <p class="status-display bg-gray-200 p-2 rounded">Новый</p> <!-- Статус отображается как текст -->
            </div>
            <div>
                <label for="name">Имя</label>
                <input type="text" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <div>
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
            </div>
            <div class="form-group text-gray-300 mt-2">
                <label for="category_id">Категория заявки</label>
                <select name="category_id" id="category_id"
                    class="tatus-display form-control rounded bg-gray-100 border border-gray-400">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class=" form-group text-gray-300 mt-2">
                <label for="subject">Тема заявки</label>
                <input type="text" name="subject" placeholder="Тема заявки" id="subject"
                    class="status-display form-control rounded bg-gray-100 border border-gray-400">
            </div>
            <div class="form-group text-gray-300 mt-2">
                <label for="message">Текст заявки</label>
                <textarea name="message" id="message" class="form-control rounded bg-gray-100"
                    placeholder="Текст заявки"></textarea>
            </div>


            <!-- Фото до -->
            <label for="photo_before">Фото до</label>
            <input type="file" name="photo_before" id="photo_before" accept="image/*"
                onchange="previewImage(event, 'photo_before_preview')">
            <div id="photo_before_preview_container">
                <img id="photo_before_preview" src="" alt="Фото до" class="mt-2"
                    style="display:none; width: 400px; height: auto;">
            </div>

            <!-- Фото после не отображается для новых заявок вообще -->
            <!-- @if(Auth::user()->isAdmin()) Проверяем, является ли пользователь администратором -->
                <!-- <label for="photo_after">Фото после</label>
                <input type="file" name="photo_after" id="photo_after" accept="image/*"
                    onchange="previewImage(event, 'photo_after_preview')">
                <div id="photo_after_preview_container">
                    <img id="photo_after_preview" src="" alt="Фото после" class="mt-2"
                        style="display:none; width: 200px; height: auto;">
                </div>
            @endif -->
        </div>
        <button type="submit" class="btn btn-success mb-5 mt-2 bg-gray-800 ">Отправить</button>
    </form>
</x-app-layout>
<script>
    // Функция для предварительного просмотра изображения
    function previewImage(event, previewId) {
        const file = event.target.files[0];
        const reader = new FileReader();

        reader.onload = function (e) {
            const imgElement = document.getElementById(previewId);
            imgElement.src = e.target.result;
            imgElement.style.display = 'block'; // Показываем изображение
        }

        if (file) {
            reader.readAsDataURL(file); // Загружаем файл как DataURL
        }
    }
</script>