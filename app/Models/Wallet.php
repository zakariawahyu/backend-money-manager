<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    protected $table = 'wallets';

    public function transaction()
    {
        return $this->hasMany(Transaction::class, 'id_wallet');
    }
}
