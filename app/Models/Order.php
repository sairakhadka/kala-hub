<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $fillable = ['customer_name', 'customer_number', 'customer_address', 'total_amount', 'advance_amount', 'delivery_date', 'customer_id'];
}
