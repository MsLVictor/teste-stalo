<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transactions = Transaction::latest()->paginate(2);
        return view('transactions.index', compact('transactions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('transactions.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $data = $request->validate([
        'valor' => ['required', 'numeric', 'min:0'],
    ]);

    \App\Models\Transaction::create($data);

    return redirect()
        ->route('transactions.index')
        ->with('success', 'Transação criada com sucesso!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction)
    {
        return view('transactions.show', compact('transaction'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction)
    {
        return view('transactions.edit', compact('transaction'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, \App\Models\Transaction $transaction)
{
    $data = $request->validate([
        'valor' => ['required', 'numeric', 'min:0'],
    ]);

    $transaction->update($data);

    return redirect()
        ->route('transactions.index')
        ->with('success', 'Transação atualizada com sucesso!');
}
    
    public function destroy(\App\Models\Transaction $transaction)
{
    $transaction->delete();

    return redirect()
        ->route('transactions.index')
        ->with('success', 'Transação excluída com sucesso!');
}
}
