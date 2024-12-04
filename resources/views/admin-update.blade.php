<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{__('Редактирование заявки')}}
        </h2>
    </x-slot>
    <form action="{{route('admin-update-submit', $data->id)}}" class="max-w-7x1 mx-auto sm:px-6 lg:px-8 mt-8"
        method="post" enctype="multipart/form-data">
        @csrf

        <div class="form-group pt-2">
            <label for="status_id">Статус заявки</label>
            <select name="status_id" id="status_id" class="form-control" onchange="toggleRejectionReason()">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}" @if($data->status_id == $status->id) selected @endif
                        @if(in_array($status->id, [2, 3]) && !Auth::user()->isAdmin()) disabled @endif>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Поле "Причина отклонения заявки" -->
        <div id="rejection-reason-container" style="display: none; margin-top: 15px;">
            <label for="rejection_reason">Причина отклонения:</label>
            <textarea name="rejection_reason" id="rejection_reason"
                class="form-control">{{$data->rejection_reason}}</textarea>
        </div>

        <div class="form-group pt-2">
            <label for="name">Имя</label>
            <input type="text" name="name" value="{{$data->name}}" placeholder="Your name" id="name"
                class="form-control">
        </div>

        <div class="form-group pt-2">
            <label for="email">Email</label>
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

        <!-- Поле загрузки фото "после" -->
        <div id="photo-after-container" style="margin-top: 15px;">
            <input type="file" name="photo_after" id="photo_after" accept="image/*"
                onchange="previewPhotoAfter(event, 'photo_after_preview')">

            <div id="photo_after_preview_container">
                <img id="photo_after_preview"
                    src="{{ $data->photo_after ? asset('storage/' . $data->photo_after) : '' }}" alt="Фото после"
                    class="mt-2"
                    style="display: {{ $data->photo_after ? 'block' : 'none' }}; width: 200px; height: auto;">
            </div>
        </div>



        <button type="submit" class="btn btn-success mt-2">Обновить</button>
    </form>

    <script>
        function toggleRejectionReason() {
            const statusSelect = document.getElementById('status_id');
            const rejectionReasonContainer = document.getElementById('rejection-reason-container');

            if (statusSelect.value == '3') { // Статус "Отклонена"
                rejectionReasonContainer.style.display = 'block';
            } else {
                rejectionReasonContainer.style.display = 'none';
                document.getElementById('rejection_reason').value = ''; // Очистить поле
            }
        }

        function togglePhotoAfter() {
            const statusSelect = document.getElementById('status_id');
            const photoAfterContainer = document.getElementById('photo-after-container');

            if (statusSelect.value == '2') { // ID статуса "Решена"
                photoAfterContainer.style.display = 'block';
            } else {
                photoAfterContainer.style.display = 'none';
                document.getElementById('photo_after').value = ''; // Очистить поле загрузки файла
            }
        }
        function previewPhotoAfter(event) {
            const fileInput = event.target;
            const preview = document.getElementById('photo_after_preview');

            if (fileInput.files && fileInput.files[0]) {
                const reader = new FileReader();

                // Когда файл будет прочитан, обновляем превью
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Показываем превью
                };

                reader.readAsDataURL(fileInput.files[0]);
            } else {
                // Если файл удален, скрываем превью
                preview.src = '';
                preview.style.display = 'none';
            }
        }

        document.addEventListener('DOMContentLoaded', () => {
            // Проверяем текущее состояние полей при загрузке страницы
            toggleRejectionReason();
            togglePhotoAfter();

            // Навешиваем обработчик на изменение статуса
            const statusSelect = document.getElementById('status_id');
            statusSelect.addEventListener('change', () => {
                toggleRejectionReason();
                togglePhotoAfter();
            });
        });
    </script>


    </script>
</x-app-layout>