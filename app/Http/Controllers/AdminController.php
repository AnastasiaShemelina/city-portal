<?php

namespace App\Http\Controllers;

use App\Http\Requests\AdminRequest;
use Illuminate\Http\Request;
use App\Models\Contact;
use App\Models\Category;

class AdminController extends Controller
{
    
    public function allData() {
        $contact = new Contact();
        return view('admin', ['data' => $contact->orderBy('created_at', 'desc')->get()]);
    }

    public function showOneMessage($id) {
        $contact = new Contact();
        return view('admin-one-message', ['data' => $contact->find($id)]);
    }

    // public function updateMessage($id) {
    //     $contact = new Contact();
    //     return view('admin-update', ['data' => $contact->find($id)]);
    // }
    public function updateMessage($id)
    {
        // Получаем заявку по ID
        $contact = Contact::find($id);

        // Получаем все категории
        $categories = Category::all();

        // Передаем заявку и категории в представление
        return view('admin-update', ['data' => $contact, 'categories' => $categories]);
    }

    public function updateMessageSubmit($id, AdminRequest $req) {

        $contact = Contact::find($id);
        $contact->name = $req->input('name');
        $contact->email = $req->input('email');
        $contact->category_id = $req->input('category_id');
        $contact->subject = $req->input('subject');
        $contact->message = $req->input('message');

        $contact->save();

        return redirect()->route('admin-data-one', $id)->with('success', 'Сообщение было обновлено');
    }
    public function deleteMessage($id) {
        Contact::find($id)->delete();
    return redirect()->route('admin-data')->with('success', 'Сообщение было удалено');
    }

}
