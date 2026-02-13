@extends('layouts.admin')

@section('title', 'Edit Broker')
@section('header', 'Edit Broker / Link')

@section('content')
    <div class="card" style="max-width: 600px; margin: 0 auto;">
        <form action="{{ route('admin.brokers.update', $broker->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label class="form-label">Broker Name</label>
                <input type="text" name="name" class="form-input" required value="{{ old('name', $broker->name) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Referral Link (URL)</label>
                <input type="url" name="referral_link" class="form-input" required
                    value="{{ old('referral_link', $broker->referral_link) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Logo URL</label>
                <input type="text" name="logo_path" class="form-input" value="{{ old('logo_path', $broker->logo_path) }}">
            </div>

            <div class="form-group">
                <label class="form-label">Description / Bonus Note</label>
                <textarea name="description" class="form-input"
                    rows="3">{{ old('description', $broker->description) }}</textarea>
            </div>

            <div class="form-check" style="margin-bottom: 1.5rem;">
                <input type="checkbox" name="is_recommended" id="is_recommended" value="1" {{ $broker->is_recommended ? 'checked' : '' }}>
                <label for="is_recommended" style="cursor: pointer;">Mark as Recommended (Highlight)</label>
            </div>

            <button type="submit" class="btn btn-primary" style="width: 100%;">Update Link</button>
        </form>
    </div>
@endsection