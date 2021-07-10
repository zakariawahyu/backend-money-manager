<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'categories';

    public function transaction()
    {
        return $this->hasMany(transaction::class, 'id_category');
    }
}
