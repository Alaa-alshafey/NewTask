<?php


use App\Models\Client;
use App\Models\Transaction;


if (!function_exists('createTransaction')) {
    function createTransaction($clientId, $userId, $type, $amount,$toClient = null)
    {
        $transaction = Transaction::create([
            'client_id' => $clientId,
            'user_id' => $userId,
            'type' => $type,
            'amount' => $amount,
            'to_client_id' => $toClient,
        ]);

        return $transaction;
    }
}

    

