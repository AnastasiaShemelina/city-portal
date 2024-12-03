<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-300 leading-tight">
            {{ __('Управление категориями') }}
        </h2>
    </x-slot>

    <div class="mt-8 generalcontainerDiv">
        <!-- Кнопка для добавления новой категории -->
        <div class="mb-4">
            <a href="{{ route('admin.categories.create') }}">
                <button class="btn btn-success">Добавить категорию</button>
            </a>
        </div>

        <!-- Список категорий -->
        <div class="category-list">
            @foreach($categories as $category)
                <div class="category-item flex justify-between mb-4">
                    <span>{{ $category->name }}</span>
                    <div class="actions">
                        <!-- Кнопка для удаления категории -->
                        <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Удалить</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>
