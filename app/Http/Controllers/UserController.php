<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Transaction;

class UserController extends Controller
{
    public function charge(Request $request, Client $client)
    {
        $lock = cache()->lock('client_' . $client->id, 10);

        if ($lock->get()) {
            try {

                $transaction = createTransaction($client->id, 4, 'charge', $request->input('amount'));

                return response()->json(['message' => 'Charge successful']);
            } finally {
                $lock->release();
            }
        } else {
            return response()->json(['message' => 'Unable to acquire lock']);
        }
    }

    public function transfer(Request $request, Client $fromClient, Client $toClient)
    {
        $lock = cache()->lock('client_' . $fromClient->id . '_' . $toClient->id, 10);

        if ($lock->get()) {
            try {

                $transaction = createTransaction($fromClient->id, 4, 'transfer', $request->input('amount'),$toClient->id);


                return response()->json(['message' => 'Transfer successful']);
            } finally {
                $lock->release();
            }
        } else {
            return response()->json(['message' => 'Unable to acquire lock']);
        }
    }
}
