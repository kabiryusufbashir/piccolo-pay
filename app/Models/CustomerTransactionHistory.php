<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerTransactionHistory extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'cust_id',
        'network_id',
        'transaction_no',
        'transaction_type',
        'transaction_amount',
        'transaction_paid',
        'reference',
        'status'
    ];

    public function transactionStatus($status)
    {
        if($status == 1){
            $status = '<div class="green-text">Success</div>';
        }else if($status == 2){
            $status = '<div class="red-text">Failed</div>';
        }else if($status == 0){
            $status = '<div class="yellow-text">Pending</div>';
        }else{
            $status = '<div class="">Nil</div>';
        }

        return $status;
    }

    public function transactionDate($date)
    {
        if(!empty($date)){
            $date_format = date('h:i A : d M, Y', strtotime($date));
            return $date_format;
        }else{
            return 'Nil';
        }
    }
}
