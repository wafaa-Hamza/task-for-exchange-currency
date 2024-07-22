@extends('layouts.app')

{{--  @section('content')  --}}
<div class="container">
    <h1>Exchange Rates</h1>
    <form action="{{ route('currencies.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="currency" class="form-label">Currency</label>
            <input type="text" class="form-control" id="currency" name="currency" required>
        </div>
        <div class="mb-3">
            <label for="rate" class="form-label">Exchange Rate</label>
            <input type="number" step="0.01" class="form-control" id="rate" name="rate" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Currency</button>
    </form>

    <h2>Existing Exchange Rates</h2>
    <ul>
        @foreach($exchangeRates as $currency => $rate)
            <li>{{ $currency }}: {{ $rate }}
                <form action="{{ route('currencies.update', $currency) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <input type="number" step="0.01" name="rate" value="{{ $rate }}" required>
                    <button type="submit">Update</button>
                </form>
                <form action="{{ route('currencies.destroy', $currency) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
{{--  @endsection  --}}
