<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;

class AdminRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     * 
     * @return bool
     */
    public function authorize()
    {
        return Auth::check(); // Только авторизованные пользователи могут отправить запрос
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'status_id' => 'required|exists:statuses,id', // Статус обязательно и должен быть существующим
            'name' => 'required|string|max:255',           // Имя обязательно, строка, до 255 символов
            'email' => 'required|email|max:255',           // Email обязательно, должен быть в формате email
            'category_id' => 'required|exists:categories,id', // Категория обязательна, должна быть существующей
            'subject' => 'required|string|max:255',         // Тема обязательна, строка, до 255 символов
            'message' => 'required|string',                  // Текст сообщения обязателен
            // Валидация для причины отклонения только если статус "Отклонена"
            'rejection_reason' => 'nullable|string', // Причина обязательна, если статус "Отклонена"
        ];
    }

    /**
     * Получите пользовательские сообщения для проверки ошибок.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'rejection_reason.required_if' => 'Причина отклонения обязательна, если статус заявки "Отклонена".',
        ];
    }
}
