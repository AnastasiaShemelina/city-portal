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
        $contacts = Contact::orderBy('created_at', 'desc')->take(5)->get();
        
        // Отправляем данные в представление
        return view('dashboard', ['data' => $contacts]);
    }
}
