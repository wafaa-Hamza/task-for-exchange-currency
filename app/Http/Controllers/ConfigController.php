<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ConfigController extends Controller
{
    public function index()
    {
        $exchangeRates = config('exchange_rates');
        return response()->json(['exchangeRates'=>$exchangeRates]);
    }

    public function store(Request $request)
    {
        // dd('ddd');
        $data = $request->validate([
            'currency' => 'required|string',
            'rate' => 'required|numeric',
        ]);

        $exchangeRates = config('exchange_rates');
        $exchangeRates[$data['currency']] = $data['rate'];
        file_put_contents(config_path('exchange_rates.php'), '<?php return ' . var_export($exchangeRates, true) . ';');

        return $exchangeRates;
    }

    public function update(Request $request, $currency)
    {
        $data = $request->validate([
            'currency' => 'string',
            'rate' => 'numeric',
        ]);

        $exchangeRates = config('exchange_rates');
        if (isset($exchangeRates[$currency])) {
            $exchangeRates[$currency] = $data['rate'];
            file_put_contents(config_path('exchange_rates.php'), '<?php return ' . var_export($exchangeRates, true) . ';');  //convert array to file php able to wrie in it
        }

        return $exchangeRates;
    }


    public function destroy($currency)
    {
        $exchangeRates = config('exchange_rates');
        if (isset($exchangeRates[$currency])) {
            unset($exchangeRates[$currency]);
            file_put_contents(config_path('exchange_rates.php'), '<?php return ' . var_export($exchangeRates, true) . ';');
        }

        return $exchangeRates;
    }
}

