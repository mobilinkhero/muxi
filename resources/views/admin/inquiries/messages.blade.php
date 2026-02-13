@extends('layouts.admin')

@section('title', 'Contact Messages')
@section('header', 'Contact Messages')

@section('content')
    <div class="card">
        <div style="overflow-x: auto;">
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($messages as $message)
                        <tr>
                            <td>#{{ $message->id }}</td>
                            <td>{{ $message->name }}</td>
                            <td>{{ $message->email }}</td>
                            <td>{{ $message->subject }}</td>
                            <td>
                                <div style="max-width: 300px; font-size: 0.9rem; color: var(--gray-light);">
                                    {{ $message->message }}
                                </div>
                            </td>
                            <td>{{ $message->created_at->format('M d, Y H:i') }}</td>
                            <td>
                                <form action="{{ route('admin.messages.destroy', $message->id) }}" method="POST"
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
                            <td colspan="7" style="text-align: center; padding: 3rem;">No messages found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div style="padding: 1rem;">
            {{ $messages->links() }}
        </div>
    </div>
@endsection