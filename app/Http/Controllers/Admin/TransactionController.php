<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::all();

        return view('admin.dashboard.transactions.index', [
            'transactions' => $transactions,
        ]);
    }

    public function show(Transaction $transaction)
    {
        return view('admin.dashboard.transactions.show', [
            'transaction' => $transaction,
        ]);
    }

    public function update(Request $request, Transaction $transaction)
    {
        $validatedData = $request->validate([
            'status' => 'required|in:pending,completed,cancelled',
        ]);

        $transaction->update([
            'status' => $validatedData['status'],
        ]);

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('admin.transactions.index')->with('success', 'Transaction deleted successfully.');
    }
}
