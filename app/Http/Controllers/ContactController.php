<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Contact;
use App\Models\Category;
use App\Models\Status;

class ContactController extends Controller
{

    // public function submitForm()
    // {
    //     // Загружаем все категории
    //     $categories = Category::all();

    //     // Передаем категории в представление
    //     return view('contact', compact('categories'));
    // }
    public function submitForm()
    {
        // Загружаем все категории
        $categories = Category::all();

        // Передаем данные пользователя и категории в представление
        return view('contact', compact('categories'))
            ->with('user', Auth::user()); // Передаем данные текущего пользователя
    }

    // public function submit(ContactRequest $req) {
    //     $contact = new Contact();
    //     $contact->id_user = Auth::user()->id;
    //     $contact->name = $req->input('name');
    //     $contact->email = $req->input('email');
    //     $contact->category_id = $req->input('category_id');
    //     $contact->subject = $req->input('subject');
    //     $contact->message = $req->input('message');

    //     // Устанавливаем статус "Новая" (id = 1)
    //     $contact->status_id = 1;

    //     $contact->save();

    //     return redirect()->route('contact')->with('success', 'Сообщение было добавлено');
    // }
    public function submit(ContactRequest $req)
    {
        $contact = new Contact();
        $contact->id_user = Auth::user()->id;  // Используем ID текущего пользователя
        $contact->name = $req->input('name');  // Имя из формы
        $contact->email = $req->input('email');  // Email из формы
        $contact->category_id = $req->input('category_id');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');

        // Устанавливаем статус "Новая" (id = 1)
        $contact->status_id = 1;


        /// Обработка фото "до"
    if ($req->hasFile('photo_before')) {
        $contact->photo_before = $req->file('photo_before')->store('photos', 'public');
    }

    // Обработка фото "после"
    if ($req->hasFile('photo_after')) {
        $contact->photo_after = $req->file('photo_after')->store('photos', 'public');
    }

        // Сохраняем заявку
        $contact->save();

        // Перенаправляем обратно с сообщением об успешной отправке
        return redirect()->route('contact')->with('success', 'Сообщение было добавлено');
    }
    public function allData()
    {
        $contact = new Contact();
        return view('messages', ['data' => $contact->orderBy('created_at', 'desc')->take(5)->get()]);
    }

    public function showOneMessage($id)
    {
        $contact = new Contact();
        return view('one-message', ['data' => $contact->find($id)]);
    }

    public function allDataUser(Request $request)
    {
        // Формируем запрос для заявок
        $contactQuery = Contact::where('id_user', Auth::user()->id) // Только заявки текущего пользователя
            ->orderBy('created_at', 'desc');

        // Проверяем, выбран ли фильтр
        if ($request->has('status_filter') && !empty($request->status_filter)) {
            $contactQuery->where('status_id', $request->status_filter);
        }

        // Получаем заявки
        $contacts = $contactQuery->get();

        // Получаем все статусы для фильтра
        $statuses = Status::all();

        return view('user-data', [
            'data' => $contacts,
            'statuses' => $statuses, // Передаем статусы в шаблон
        ]);
    }


    public function showOneMessageUser($id)
    {
        $contact = new Contact();
        return view('user-one-message', ['data' => $contact->find($id)]);
    }

    // public function updateMessage($id) {
    //     $contact = new Contact();
    //     return view('user-update', ['data' => $contact->find($id)]);
    // }

    public function updateMessage($id)
    {
        // Получаем заявку по ID
        $contact = Contact::find($id);

        // Получаем все категории
        $categories = Category::all();

        // Передаем заявку и категории в представление
        return view('user-update', ['data' => $contact, 'categories' => $categories]);
    }

    public function deleteMessage($id)
    {
        Contact::find($id)->delete();
        return redirect()->route('user-data')->with('success', 'Сообщение было удалено');
    }

    // public function updateMessageSubmit($id, ContactRequest $req) {

    //     $contact = Contact::find($id);
    //     $contact->name = $req->input('name');
    //     $contact->email = $req->input('email');
    //     $contact->category_id = $req->input('category_id');
    //     $contact->subject = $req->input('subject');
    //     $contact->message = $req->input('message');
    //     $contact->save();
    //     return redirect()->route('user-data-one', $id)->with('success', 'Сообщение было обновлено');
    // }
    public function updateMessageSubmit($id, ContactRequest $req)
    {
        $contact = Contact::find($id);

        // Убедимся, что только администратор может изменять статус
        if (Auth::user()->isAdmin()) {  // Используем метод isAdmin
            // Логика изменения статуса, например, с "Новый" на "Решена" или "Отклонена"
            if ($contact->status_id == 1) { // Статус "Новый"
                // Обновляем статус на новый, который передан в запросе
                $contact->status_id = $req->input('status_id');
            }
        }

        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->category_id = $req->input('category_id');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');
        $contact->save();

        // Обработка загрузки изображения "до"
        if ($req->hasFile('photo_before')) {
            $contact->photo_before = $req->file('photo_before')->store('photos', 'public');
        }

        // Обработка загрузки изображения "после"
        if ($req->hasFile('photo_after')) {
            $contact->photo_after = $req->file('photo_after')->store('photos', 'public');
        }

        return redirect()->route('user-data-one', $id)->with('success', 'Сообщение было обновлено');
    }

    

}
