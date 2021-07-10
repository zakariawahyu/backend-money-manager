<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $table = 'transactions';

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, 'id_wallet');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
