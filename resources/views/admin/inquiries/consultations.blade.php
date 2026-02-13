@extends('layouts.admin')

@section('title', 'Consultation Requests')
@section('header', 'Consultation Requests')

@section('content')
    <div class="card">
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Capital</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($consultations as $consultation)
                        <tr>
                            <td>#{{ $consultation->id }}</td>
                            <td>{{ $consultation->name }}</td>
                            <td>{{ $consultation->email }}</td>
                            <td>
                                <span class="badge badge-primary">{{ $consultation->capital }}</span>
                            </td>
                            <td>{{ $consultation->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.consultations.destroy', $consultation->id) }}" method="POST"
                                    onsubmit="return confirm('Are you sure?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-secondary btn-sm"
                                        style="color: #ef4444; border-color: #ef4444;">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" style="text-align: center; padding: 3rem;">No consultation requests found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding: 1rem;">
            {{ $consultations->links() }}
        </div>
    </div>
@endsection