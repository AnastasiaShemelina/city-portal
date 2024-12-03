<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{__('Редактирование заявки')}}
        </h2>
    </x-slot>
    <form action="{{route('admin-update-submit', $data->id)}}" class="max-w-7x1 mx-auto sm:px-6 lg:px-8 mt-8" method="post">
        @csrf

        <div class="form-group pt-2">
            <label for="status_id">Статус заявки</label>
            <select name="status_id" id="status_id" class="form-control" onchange="toggleRejectionReason()">
                @foreach($statuses as $status)
                    <option value="{{ $status->id }}"
                        @if($data->status_id == $status->id) selected @endif
                        @if(in_array($status->id, [2, 3]) && !Auth::user()->isAdmin()) disabled @endif>
                        {{ $status->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <!-- Поле "Причина отклонения заявки" -->
        <div id="rejection-reason-container" style="display: none; margin-top: 15px;">
            <label for="rejection_reason">Причина отклонения:</label>
            <textarea name="rejection_reason" id="rejection_reason" class="form-control">{{$data->rejection_reason}}</textarea>
        </div>

        <div class="form-group pt-2">
            <label for="name">Имя</label>
            <input type="text" name="name" value="{{$data->name}}" placeholder="Your name" id="name" class="form-control">
        </div>

        <div class="form-group pt-2">
            <label for="email">Email</label>
            <input type="text" name="email" value="{{$data->email}}" placeholder="Your e-mail" id="email" class="form-control">
        </div>

        <div class="form-group pt-2">
            <label for="category_id">Категория</label>
            <select name="category_id" id="category_id" class="form-control" required>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" 
                        @if($data->category_id == $category->id) selected @endif>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group pt-2">
            <label for="subject">Тема заявки</label>
            <input type="text" name="subject" value="{{$data->subject}}" placeholder="Тема заявки" id="subject" class="form-control">
        </div>

        <div class="form-group pt-2">
            <label for="message">Текст заявки</label>
            <textarea type="text" name="message" placeholder="Текст заявки" id="message" class="form-control">{{$data->message}}</textarea>
        </div>

        <input type="submit" class="btn btn-success mt-2" value="Обновить">
    </form>

    <!-- JavaScript для управления полем "Причина отклонения" -->
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

        document.addEventListener('DOMContentLoaded', toggleRejectionReason);

    </script>
</x-app-layout>
