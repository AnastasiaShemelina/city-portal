<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class PhotoController extends Controller
{
    public function index()
    {
        // Получаем последние 4 заявки со статусом "Решена"
        $data = Contact::where('status_id', '2')  // Фильтрация по статусу "Решена"
                       ->orderBy('created_at', 'desc')  // Сортировка по дате создания (по убыванию)
                       ->take(4)  // Ограничиваем выборку 4 последними заявками
                       ->get();

        // Подсчитываем общее количество заявок со статусом "Решена"
        $resolvedCount = Contact::where('status_id', '2')->count();

        // Передаём данные в представление
        return view('photo-page', ['data' => $data, 'resolvedCount' => $resolvedCount]);
        


    }
}