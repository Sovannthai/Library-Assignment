<?php

namespace App\Models;

use App\Models\BorrowDetail;
use Illuminate\Database\Eloquent\Model;
use GuzzleHttp\Promise\FulfilledPromise;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Book extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function catelog()
    {
        return $this->belongsTo(Catelog::class,'cate_id');
    }
    public function borrow()
    {
        return $this->hasMany(Borrow::class);
    }
    public function createdBy ()
    {
        return $this->belongsTo(User::class,'created_by');
    }
    public function borrow_detail()
    {
        return $this->hasMany(BorrowDetail::class);
    }
}
