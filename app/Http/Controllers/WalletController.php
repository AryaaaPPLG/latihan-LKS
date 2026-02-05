<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\User;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;

class WalletController extends Controller
{

public function index()
{
    $transactions = Transaction::where('user_id', Auth::id())->latest()->get();

    return view('home', compact('transactions'));
}

    public function topUp(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1000',
        ]);     
        // mencari user berdasarkan user_id
        $user = User::find($request->user_id);
        
        // menambahkan saldo
        $user->balance += $request->amount;
        $user->save();
        
        Transaction::create([
            'user_id' => $user->id,
            'type' => 'topup',
            'amount' => $request->amount,
            'description' => 'Top up saldo',
        ]);

        return redirect()->back()->with('success', 'Top up berhasil!');
    }

    public function pay(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:1000',
            'description' => 'nullable|string',
        ]);

        $user = Auth::user();

        if ($user->balance < $request->amount) {
            return redirect()->back()->with('error', 'Saldo tidak cukup!');
        }

        $user->balance - $request->amount;
        $user->save();

        Transaction::create([
            'user_id' => $user->id,
            'type' => 'pay',
            'amount' => $request->amount,
            'description' => $request->description,
        ]);

        return redirect()->back()->with('success', 'Pembayaran berhasil!');
    }
}
