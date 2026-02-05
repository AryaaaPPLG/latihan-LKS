<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $all = Transaction::with('user')->latest()->get();
        return view('transaksi.index', compact('all'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(User $users)
    {
        $users = User::all();
        return view('transaksi.create', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'amount' => 'required|numeric|min:1000', // Pake numeric lebih aman drpd decimal
            'type' => 'required|in:topup,pay',
            'description' => 'nullable'
        ]);

        // --- LOGIKA LEVEL LKS (Pake DB Transaction) ---
        // Biar kalau update saldo gagal, catat riwayat juga batal (Data Konsisten)
        DB::transaction(function () use ($validated) {
            
            // 1. Buat Riwayat Transaksi
            Transaction::create($validated);

            // 2. Cari Usernya
            $user = User::findOrFail($validated['user_id']);

            // 3. Update Saldonya (Sinkronisasi)
            if ($validated['type'] == 'topup') {
                $user->increment('balance', $validated['amount']);
            } else {
                // Cek dulu cukup ga saldonya (Opsional buat Admin, tapi bagus ada)
                if($user->balance < $validated['amount']) {
                     throw new \Exception("Saldo user tidak cukup!");
                }
                $user->decrement('balance', $validated['amount']);
            }
        });

        // PENTING: Pake redirect, bukan view
        return redirect()->route('transaksis.index')->with('success', 'Transaction Berhasil & Saldo Ditambahkan');
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaksi)
    {
        $users = User::all();
        return view('transaksi.edit', compact('transaksi','users'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaksi)
    {
        $validated = $request->validate([
            'description' => 'required'
        ]);

        $transaksi->update([
            'description' => $validated['description']
        ]);
        return redirect()->route('transaksis.index')->with('success', 'Data Berhasil Di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $transaksi = Transaction::findOrFail($id);

        $user = User::findOrFail($transaksi->user_id);

        if($transaksi->type == 'topup'){
            $user->decrement('balance', $transaksi->amount);
        } else {
            $user->increment('balance', $transaksi->amount);
        }

        $transaksi->delete();
        return redirect()->route('transaksis.index')->with('success', 'Data Berhasil Dihapus');
    }
}
