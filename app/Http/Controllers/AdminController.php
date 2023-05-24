<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

    
    class AdminController extends Controller
    {
        public function report()
        {
            $transactions = Client::with(['transactions', 'transactions.user', 'transactions.toClient'])
                ->join('transactions', 'clients.id', '=', 'transactions.client_id')
                ->orderBy('transactions.created_at')
                ->get(['clients.*']);
    
            $report = [];
            foreach ($transactions as $client) {
                foreach ($client->transactions as $transaction) {
                    $balanceAfter = $client->balance - $transaction->amount;
    
                    $operationDetails = $this->getOperationDetails($transaction);
    
                    $toClientName = '';
                    if ($transaction->type === 'transfer' && $transaction->toClient) {
                        $toClientName = $transaction->toClient->name;
                    }
    
                    $report[] = [
                        'datetime' => $transaction->created_at,
                        'client_name' => $client->name,
                        'balance_before' => $client->balance,
                        'amount' => $transaction->amount,
                        'balance_after' => $balanceAfter,
                        'operation_details' => $operationDetails,
                        'user_name' => $transaction->user->name,
                        'to_client_name' => $toClientName,
                    ];
                }
            }
    
            return response()->json($report);
        }
    
        private function getOperationDetails($transaction)
        {
            $details = '';
            switch ($transaction->type) {
                case 'purchase':
                    $details = 'Buying vodafone charging card of ' . $transaction->amount . ' le';
                    break;
                case 'charge':
                    $details = 'Charging balance from admin #' . $transaction->user->name;
                    break;
                case 'transfer':
                    $details = 'Transferring balance from Client B #' . $transaction->user->name;
                    break;
            }
            return $details;
        }
    }
    