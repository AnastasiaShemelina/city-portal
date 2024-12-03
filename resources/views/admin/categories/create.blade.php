<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{ __('Добавить новую категорию') }}
        </h2>
    </x-slot>

    <div class="mt-8">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="name" class="block text-gray-700">Название категории</label>
                <input type="text" name="name" id="name" class="mt-2 p-2 border rounded w-full" required>
            </div>

            <div class="mb-4">
                <button type="submit" class="btn btn-primary">Создать категорию</button>
            </div>
        </form>
    </div>
</x-app-layout>
