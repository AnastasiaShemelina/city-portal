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

    <form action="{{ route('contact-form')}}" class="max-w-7xl mx-auto sm:px-6 lg:px-8" method="post">
        @csrf
        <div class="dark:text-gray-800">
            <div class="form-group text-gray-300 mt-2">
                <label for="status">Статус заявки</label>
                <p class="bg-gray-200 p-2 rounded">Новый</p> <!-- Статус отображается как текст -->
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
                <select name="category_id" id="category_id" class="form-control rounded bg-gray-100 border border-gray-400">
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class=" form-group text-gray-300 mt-2">
                <label for="subject">Тема заявки</label>
                <input type="text" name="subject" placeholder="Тема заявки" id="subject" class="form-control rounded bg-gray-100 border border-gray-400">
            </div>
            <div class="form-group text-gray-300 mt-2">
                <label for="message">Текст заявки</label>
                <textarea name="message" id="message" class="form-control rounded bg-gray-100" placeholder="Текст заявки"></textarea>
            </div>
        </div>
        <button type="submit" class="btn btn-success mt-2 bg-gray-800 ">Отправить</button>
    </form>
</x-app-layout>
