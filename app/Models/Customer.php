<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, Notifiable;
    protected $guarded = [];
    public function customer_type()
    {
        return $this->belongsTo(CustomerType::class,'customer_type_id');
    }
    public function borrow()
    {
        return $this->hasMany(Borrow::class);
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function routeNotificationForTelegram()
    {
        return $this->telegram_user_id;
    }
}
