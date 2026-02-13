@extends('layouts.admin')

@section('title', 'Manage Brokers')
@section('header', 'Broker / Referral Links')

@section('actions')
    <a href="{{ route('admin.brokers.create') }}" class="btn btn-primary btn-sm">Add New Broker</a>
@endsection

@section('content')
    <div class="card">
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>Logo</th>
                        <th>Name</th>
                        <th>Referral Link</th>
                        <th>Recommended</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($brokers as $broker)
                        <tr>
                            <td>
                                @if($broker->logo_path)
                                    <img src="{{ $broker->logo_path }}" style="width: 40px; height: 40px; object-fit: contain;">
                                @else
                                    <span style="font-size: 1.5rem;">🔗</span>
                                @endif
                            </td>
                            <td>{{ $broker->name }}</td>
                            <td>
                                <a href="{{ $broker->referral_link }}" target="_blank"
                                    style="color: var(--primary);">{{ Str::limit($broker->referral_link, 30) }}</a>
                            </td>
                            <td>
                                @if($broker->is_recommended)
                                    <span style="color: #10b981;">Yes</span>
                                @else
                                    <span style="color: var(--gray);">No</span>
                                @endif
                            </td>
                            <td>
                                <div style="display: flex; gap: 0.5rem;">
                                    <a href="{{ route('admin.brokers.edit', $broker->id) }}"
                                        class="btn btn-secondary btn-sm">Edit</a>
                                    <form action="{{ route('admin.brokers.destroy', $broker->id) }}" method="POST"
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
                            <td colspan="5" style="text-align: center; padding: 2rem;">No brokers found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection