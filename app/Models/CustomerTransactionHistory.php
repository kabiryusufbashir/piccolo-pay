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
        'profit',
        'reference',
        'status'
    ];

    public function transactionStatus($status)
    {
        if($status == 1){
            $status = '<div class="green-text">Success</div>';
        }else if($status == 2){
            $status = '<div class="yellow-text">Pending</div>';
        }else if($status == 0){
            $status = '<div class="red-text">Failed</div>';
        }else{
            $status = '<div class="">Nil</div>';
        }

        return $status;
    }

    public function transactionDate($date)
    {
        if(!empty($date)) {
            // Convert the input date to a timestamp
            $timestamp = strtotime($date);
        
            // Add the offset for GMT+1 (3600 seconds = 1 hour)
            $timestamp += 3600; // 3600 seconds = 1 hour
        
            // Format the adjusted timestamp
            $date_format = date('h:i A : d M, Y', $timestamp);
        
            return $date_format;
        }else{
            return 'Nil';
        }        
        
    }

    public function amountReadable($billed){
        if($billed){
            $amountBilled_readable = '₦'.number_format($billed, 2, '.', ',');
            return $amountBilled_readable;
        }else{
            return '₦0.00';
        }
    }
}
