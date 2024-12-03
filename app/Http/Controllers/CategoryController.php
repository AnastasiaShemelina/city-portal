<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Отображение списка категорий
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));
    }

    // Страница для создания новой категории
    public function create()
    {
        return view('admin.categories.create');
    }

    // Сохранение новой категории
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Category::create([
            'name' => $request->name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Категория успешно добавлена!');
    }

    // Удаление категории
    public function destroy(Category $category)
    {
        // Удаляем все заявки, связанные с этой категорией
        $category->contacts()->delete();

        // Удаляем саму категорию
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Категория и связанные с ней заявки были удалены!');
    }
}
