<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = ['name','balance'];

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

}
