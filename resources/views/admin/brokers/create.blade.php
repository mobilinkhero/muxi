@extends('layouts.admin')

@section('title', 'Add Broker')
@section('header', 'Add Broker / Link')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <form action="{{ route('admin.brokers.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label class="form-label">Broker Name</label>
                <input type="text" name="name" class="form-input" required>
            </div>

            <div class="form-group">
                <label class="form-label">Referral Link (URL)</label>
                <input type="url" name="referral_link" class="form-input" required placeholder="https://...">
            </div>

            <div class="form-group">
                <label class="form-label">Logo URL</label>
                <input type="text" name="logo_path" class="form-input" placeholder="https://example.com/logo.png">
            </div>

            <div class="form-group">
                <label class="form-label">Description / Bonus Note</label>
                <textarea name="description" class="form-input" rows="3"
                    placeholder="e.g. Get $50 bonus on sign up"></textarea>
            </div>

            <div class="form-check" style="margin-bottom: 1.5rem;">
                <input type="checkbox" name="is_recommended" id="is_recommended" value="1">
                <label for="is_recommended" style="cursor: pointer;">Mark as Recommended (Highlight)</label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Add Link</button>
        </form>
    </div>
@endsection