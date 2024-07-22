<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AmountController extends Controller
{
    public function index()
    {
        $amounts = \App\Models\Amount::all()->map(function ($amount) {
            $exchangeRates = config('exchange_rates');
            $rate = $exchangeRates[$amount->currency] ?? 1;   // rate def=1
            return [
                'id' => $amount->id,
                'amount' => $amount->amount,
                'currency' => $amount->currency,
                'exchange_value' => $amount->amount * $rate,
            ];

        });

        return view('amounts.index', compact('amounts'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric',
            'currency' => 'required|string',
        ]);

        $amount = \App\Models\Amount::create($request->all());

        return redirect()->route('amounts.index');
    }

    public function update(Request $request, $id)
    {
      $amounts= $request->validate([
            'amount' => 'numeric',
            'currency' => 'string',
        ]);

        $amount = \App\Models\Amount::findOrFail($id);
        $amount->update($amounts);

        return redirect()->route('amounts.index');
    }

    public function destroy($id)
    {
        $amount = \App\Models\Amount::findOrFail($id);
        $amount->delete();

        return redirect()->route('amounts.index');
    }}
