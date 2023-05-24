<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Client;
use App\Models\Transaction;
use App\Helpers\helpers;

class ClientController extends Controller
{
    public function buy(Request $request, Client $client)
    {
        $lock = cache()->lock('client_' . $client->id, 10);

        if ($lock->get()) {
            try {
                $transaction = createTransaction($client->id, 3, 'purchase', $request->input('amount'));
                return response()->json(['message' => 'Purchase successful']);
            
            } finally {
                $lock->release();
            }
        } else {
            return response()->json(['message' => 'Unable to acquire lock']);
        }
    }
}
