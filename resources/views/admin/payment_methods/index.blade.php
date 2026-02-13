@extends('layouts.admin')

@section('title', 'Payment Methods')
@section('header', 'Payment Methods')

@section('actions')
    <a href="{{ route('admin.payment-methods.create') }}" class="btn btn-primary btn-sm">Add New Method</a>
@endsection

@section('content')
    <div class="card">
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Icon</th>
                        <th>Name</th>
                        <th>Details</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($paymentMethods as $method)
                        <tr>
                            <td>
                                @if($method->icon)
                                    <img src="{{ $method->icon }}" style="width: 32px; height: 32px; object-fit: contain;">
                                @else
                                    <span style="font-size: 1.5rem;">💳</span>
                                @endif
                            </td>
                            <td>{{ $method->name }}</td>
                            <td>
                                @if($method->account_name)
                                    <div>{{ $method->account_name }}</div>
                                @endif
                                <div style="font-family: monospace; color: var(--primary);">{{ $method->account_number }}</div>
                                <small style="color: var(--gray);">{{ $method->network ?? $method->bank_name }}</small>
                            </td>
                            <td>
                                @if($method->is_active)
                                    <span style="color: #10b981;">Active</span>
                                @else
                                    <span style="color: #ef4444;">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.payment-methods.edit', $method->id) }}"
                                        class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('admin.payment-methods.destroy', $method->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-secondary btn-sm"
                                            style="color: #ef4444; border-color: #ef4444;">Delete</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" style="text-align: center; padding: 2rem;">No payment methods found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection