<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catelog extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function book()
    {
        return $this->hasMany(Book::class);
    }
}
