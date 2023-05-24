<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $fillable = ['client_id', 'user_id', 'type', 'amount', 'to_client_id'];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function toClient()
    {
        return $this->belongsTo(Client::class, 'to_client_id');
    }
}

