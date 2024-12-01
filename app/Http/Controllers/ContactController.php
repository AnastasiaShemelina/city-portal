<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ContactRequest;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Contact;
use App\Models\Category;

class ContactController extends Controller
{
    public function submitForm()
    {
        // Загружаем все категории
        $categories = Category::all();
    
        // Передаем категории в представление
        return view('contact', compact('categories'));
    }
    public function submit(ContactRequest $req) {
        $contact = new Contact();
        $contact->id_user = Auth::user()->id;
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->category_id = $req->input('category_id');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');
        $contact->save();
        return redirect()->route('contact')->with('success', 'Сообщение было добавлено');
    }
    public function allData() {
        $contact = new Contact();
        return view('messages', ['data' => $contact->orderBy('created_at', 'desc')->take(5)->get()]);
    }

    public function showOneMessage($id) {
        $contact = new Contact();
        return view('one-message', ['data' => $contact->find($id)]);
    }

    public function allDataUser() {
        $contact = new Contact();
        return view('user-data', ['data' => $contact->orderBy('created_at', 'desc')->where('id_user', Auth::user()->id)->get()]);
    }

    public function showOneMessageUser($id) {
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

    public function deleteMessage($id) {
        Contact::find($id)->delete();
        return redirect()->route('user-data')->with('success', 'Сообщение было удалено');
    }

    public function updateMessageSubmit($id, ContactRequest $req) {
        
        $contact = Contact::find($id);
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->category_id = $req->input('category_id');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');
        $contact->save();
        return redirect()->route('user-data-one', $id)->with('success', 'Сообщение было обновлено');
    }
}
