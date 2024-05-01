<?php

namespace App\Models;

use GuzzleHttp\Promise\FulfilledPromise;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
