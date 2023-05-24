<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Lock;
use App\Models\Client;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Helpers\TransactionHelper;

class TransactionController extends Controller {
    public function buy(Request $request) {
        // Acquire locks for involved clients
        Lock::acquire(['clientA', 'clientB']);

        // Perform the buying operation
        // ...

        // Save the transaction in the database

        $transaction = TransactionHelper::createTransaction($request->input('client_id'), 'buying', $request->input('amount'));


        // Release locks
        Lock::release(['clientA', 'clientB']);

        // Return response
        // ...
    }

    public function charge(Request $request) {
        // Acquire locks for involved clients
        Lock::acquire(['clientA']);

        // Perform the charging operation
        // ...
        // Save the transaction in the database
        $transaction = TransactionHelper::createTransaction($request->input('client_id'), 'charging', $request->input('amount'));
        // Release locks
        Lock::release(['clientA']);

        // Return response
        // ...
    }

    public function transfer(Request $request) {
        // Acquire locks for involved clients
        Lock::acquire(['clientA', 'clientB']);

        // Perform the transferring operation
        // ...

        // Save the transaction in the database
        $transaction = TransactionHelper::createTransaction($request->input('sender_id'), 'transferring', $request->input('amount'));

        // Save the transaction for the receiver
        $transaction = TransactionHelper::createTransaction($request->input('receiver_id'), 'receiving', $request->input('amount'));

        // Release locks
        Lock::release(['clientA', 'clientB']);

        // Return response
        // ...
    }
}


