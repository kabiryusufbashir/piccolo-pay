<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransactionHistory extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'cust_id',
        'transaction_type',
        'transaction_amount',
        'transaction_paid',
        'reference',
        'status'
    ];
}
