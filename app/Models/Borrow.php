<?php

namespace App\Models;

use App\Models\BorrowDetail;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Borrow extends Model
{
    use HasFactory, Notifiable;
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $casts = [
        'book_id' => 'array',
    ];
    protected $guarded = [];
    public function books()
    {
        return $this->belongsTo(Book::class,'book_id');
    }
    public function customer()
    {
        return $this->belongsTo(customer::class,'customer_id');
    }
    public function borrow_detail()
    {
        return $this->hasMany(BorrowDetail::class);
    }
    public function catelog()
    {
        return $this->belongsTo(Catelog::class,'catelog_id');
    }
    public function createdBy()
    {
        return $this->belongsTo(User::class,'created_by');
    }
}
