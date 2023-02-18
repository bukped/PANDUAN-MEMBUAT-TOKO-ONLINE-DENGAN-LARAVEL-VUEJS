<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Sanctum\HasApiTokens;

class Customers extends Model
{
    use HasApiTokens;

    protected $table = 'customers';

    protected $fillable = [
        'customer_name', 'customer_optional', 'email', 'password', 'address', 'number'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function transaction(){
        return $this->hasMany(Transaction::class, 'customer_id');
    }


}
