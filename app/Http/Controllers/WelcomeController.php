<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;  // Подключаем модель Contact

class WelcomeController extends Controller
{
    public function index()
    {
        $data = Contact::orderBy('created_at', 'desc')->take(5)->get();
        return view('welcome', ['data' => $data]);
    }
}