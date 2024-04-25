<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function customer_type()
    {
        return $this->belongsTo(CustomerType::class,'customer_type_id');
    }
}
