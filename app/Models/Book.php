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
}
