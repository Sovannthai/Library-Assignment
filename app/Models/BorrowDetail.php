<?php

namespace App\Models;

use App\Models\Borrow;
use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BorrowDetail extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function borrow()
    {
        return $this->belongsTo(Borrow::class, 'borrow_id');
    }
    public function book()
    {
        return $this->belongsTo(Book::class,'book_id');
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }
}
