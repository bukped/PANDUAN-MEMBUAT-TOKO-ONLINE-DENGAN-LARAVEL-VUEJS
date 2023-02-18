<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    // use SoftDeletes;


    protected $fillable = [
        'uuid',
        'customer_id',
        'transaction_total',
        'transaction_status',
        'transaction_proof'
    ];

    protected $hidden = [

    ];

    public function details(){
        return $this->hasMany(TransactionDetail::class, 'transactions_id');
    }

    public function customer(){
        return $this->belongsTo(Customers::class, 'customer_id', 'id');
    }

    public function getTransactionProofAttribute($value){
        return url('storage/', $value);
    }

}
