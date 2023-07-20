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

        return view('admin.transaction.index', [
            'transaction' => $transactions,
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

        return redirect()->route('transaction.index')->with('success', 'Transaction updated successfully.');
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect()->route('transaction.index')->with('success', 'Transaction deleted successfully.');
    }
    public function status($id)
    {
        $data  = Transaction::find($id);
        if ($data->active == true) {
            $data->active = false;
        } else {
            $data->active = true;
        }
        $data->save();
        return redirect()->route('transaction.index')->with('success', 'Transactionstatus update successfully.');
    }
}
