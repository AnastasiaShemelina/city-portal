<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    // Добавьте новые поля в $fillable
    protected $fillable = [
        'id_user',
        'name',
        'email',
        'subject',
        'message',
        'photo_before',  // новое поле
        'photo_after',   // новое поле
        'rejection_reason',
    ];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

}
