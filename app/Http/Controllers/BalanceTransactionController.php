<?php

namespace App\Http\Controllers;

use App\Models\BalanceTransaction;
use Illuminate\Http\Request;

class BalanceTransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'transaction_code' => 'required|string|min:4',
            'total_price' => 'required|numeric|min:0',
            'basket_items' => 'required|array',
        ]);

        BalanceTransaction::create([
            'user_id' => auth()->id(),
            'transaction_code' => $request->transaction_code,
            'total_price' => $request->total_price,
            'basket_items' => $request->basket_items,
            'status' => 'pending', // Başlangıçta bekleyen işlem olarak ekliyoruz
        ]);

        session()->flash('success', 'Transaction saved successfully!');

        return redirect()->back();
    }
}
