@extends('layouts.admin')

@section('title', 'Edit Payment Method')
@section('header', 'Edit Payment Method')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <form action="{{ route('admin.payment-methods.update', $paymentMethod->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Method Name (e.g., USDT TRC20, Bank Transfer)</label>
                <input type="text" name="name" class="form-input" required value="{{ old('name', $paymentMethod->name) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Account Number / Wallet Address</label>
                <input type="text" name="account_number" class="form-input" required
                    value="{{ old('account_number', $paymentMethod->account_number) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Account Holder Name (Optional)</label>
                <input type="text" name="account_name" class="form-input"
                    value="{{ old('account_name', $paymentMethod->account_name) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Bank Name (For Bank) or Network (For Crypto)</label>
                <input type="text" name="bank_name" class="form-input"
                    value="{{ old('bank_name', $paymentMethod->bank_name ?? $paymentMethod->network) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Instructions / Notes (Optional)</label>
                <textarea name="instruction" class="form-input"
                    rows="3">{{ old('instruction', $paymentMethod->instruction) }}</textarea>
            </div>

            <div class="form-group">
                <label class="form-label">Icon URL (Optional)</label>
                <input type="text" name="icon" class="form-input" value="{{ old('icon', $paymentMethod->icon) }}">
            </div>

            <div class="form-check" style="margin-bottom: 1.5rem;">
                <input type="checkbox" name="is_active" id="is_active" value="1" {{ $paymentMethod->is_active ? 'checked' : '' }}>
                <label for="is_active" style="cursor: pointer;">Active</label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Update Payment Method</button>
        </form>
    </div>
@endsection