<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    protected $table = 'transaction_types';

    public function category()
    {
        return $this->hasMany(Category::class, 'id_transaction_type');
    }
}
