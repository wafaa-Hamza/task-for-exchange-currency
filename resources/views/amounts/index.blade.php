@extends('layouts.app')

{{--  @section('content')  --}}
<div class="container">
    <h1>Amounts</h1>
    <form action="{{ route('amounts.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="currency" class="form-label">Currency</label>
            <input type="text" class="form-control" id="currency" name="currency" required>
        </div>
        <div class="mb-3">
            <label for="amount" class="form-label">Amount</label>
            <input type="number" step="0.01" class="form-control" id="amount" name="amount" required>
        </div>
        <button type="submit" class="btn btn-primary">Add Amount</button>
    </form>

    <h2>Existing Amounts</h2>
    <ul>
        @foreach($amounts as $amount)
        <li>{{ $amount['currency'] }}: {{ $amount['amount'] }}

                (Exchange Value: {{ $amount['exchange_value'] }})
                <form action="{{ route('amounts.update', $amount['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <input type="text" name="currency" value="{{ $amount['currency'] }}" required>
                    <input type="number" step="0.01" name="amount" value="{{ $amount['amount'] }}" required>
                    <button type="submit">Update</button>
                </form>
                <form action="{{ route('amounts.destroy', $amount['id']) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Delete</button>
                </form>
            </li>
        @endforeach
    </ul>
</div>
{{--  @endsection  --}}
