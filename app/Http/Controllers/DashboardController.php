<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;  // Подключаем модель Contact

class DashboardController extends Controller
{
    // Метод для отображения последних 5 заявок
    public function index()
    {
        // Получаем последние 5 заявок
        $contacts = Contact::where('status_id', '2')  // Фильтрация по статусу "Решена"
                           ->orderBy('created_at', 'desc')  // Сортировка по дате создания (по убыванию)
                           ->take(4)  // Ограничиваем выборку 4 последними заявками
                           ->get();
        
        // Отправляем данные в представление
        return view('dashboard', ['data' => $contacts]);
    }
}
