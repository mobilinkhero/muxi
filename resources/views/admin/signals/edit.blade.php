<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Signal - GSM Admin</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        body {
            background: var(--dark);
            color: var(--white);
            font-family: var(--font-primary);
        }

        .container {
            max-width: 800px;
            margin: 2rem auto;
            padding: 0 1rem;
        }

        .form-card {
            background: var(--dark-light);
            border-radius: var(--radius-md);
            padding: 2rem;
            border: 1px solid rgba(255, 255, 255, 0.05);
        }

        label {
            display: block;
            margin-bottom: 0.5rem;
            color: var(--gray-light);
            font-weight: 500;
        }

        input,
        select,
        textarea {
            width: 100%;
            padding: 0.75rem;
            background: var(--dark);
            border: 1px solid rgba(255, 255, 255, 0.1);
            color: var(--white);
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
            font-family: inherit;
        }

        input:focus,
        select:focus,
        textarea:focus {
            border-color: var(--primary);
            outline: none;
        }

        .row {
            display: flex;
            gap: 1rem;
        }

        .col {
            flex: 1;
        }

        .alert-danger {
            background: rgba(239, 68, 68, 0.1);
            border: 1px solid rgba(239, 68, 68, 0.2);
            color: #ef4444;
            padding: 1rem;
            border-radius: var(--radius-sm);
            margin-bottom: 1.5rem;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2 style="margin-bottom: 2rem;">Edit Signal: {{ $signal->symbol }}</h2>

        @if ($errors->any())
            <div class="alert-danger">
                <ul style="margin-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">
            <form action="{{ route('admin.signals.update', $signal->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col">
                        <label>Symbol / Pair</label>
                        <input type="text" name="symbol" value="{{ old('symbol', $signal->symbol) }}" required>
                    </div>
                    <div class="col">
                        <label>Type</label>
                        <select name="type">
                            <option value="BUY" {{ $signal->type == 'BUY' ? 'selected' : '' }}>BUY 🟢</option>
                            <option value="SELL" {{ $signal->type == 'SELL' ? 'selected' : '' }}>SELL 🔴</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Entry Price</label>
                        <input type="text" name="entry_price" value="{{ old('entry_price', $signal->entry_price) }}"
                            required>
                    </div>
                    <div class="col">
                        <label>Stop Loss 🛑</label>
                        <input type="text" name="stop_loss" value="{{ old('stop_loss', $signal->stop_loss) }}"
                            style="border-color: rgba(239, 68, 68, 0.5);" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Take Profit 1 🎯</label>
                        <input type="text" name="take_profit_1"
                            value="{{ old('take_profit_1', $signal->take_profit_1) }}"
                            style="border-color: rgba(16, 185, 129, 0.5);" required>
                    </div>
                    <div class="col">
                        <label>Take Profit 2</label>
                        <input type="text" name="take_profit_2"
                            value="{{ old('take_profit_2', $signal->take_profit_2) }}">
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Status</label>
                        <select name="status" style="background: rgba(30, 41, 59, 0.8);">
                            <option value="active" {{ $signal->status == 'active' ? 'selected' : '' }}>Active 🟢</option>
                            <option value="closed" {{ $signal->status == 'closed' ? 'selected' : '' }}>Closed 🏁</option>
                            <option value="cancelled" {{ $signal->status == 'cancelled' ? 'selected' : '' }}>Cancelled 🚫
                            </option>
                        </select>
                    </div>
                    <div class="col">
                        <label>Result (If Closed)</label>
                        <select name="result">
                            <option value="" {{ $signal->result == '' ? 'selected' : '' }}>Running / None</option>
                            <option value="profit" {{ $signal->result == 'profit' ? 'selected' : '' }}>Profit 💰</option>
                            <option value="loss" {{ $signal->result == 'loss' ? 'selected' : '' }}>Loss 🔻</option>
                            <option value="breakeven" {{ $signal->result == 'breakeven' ? 'selected' : '' }}>Break Even ⚖️
                            </option>
                        </select>
                    </div>
                </div>

                <label>Analysis / Notes</label>
                <textarea name="notes" rows="4">{{ old('notes', $signal->notes) }}</textarea>

                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <a href="{{ route('admin.signals.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Update Signal</button>

                    <button type="button"
                        onclick="if(confirm('Delete this signal?')) document.getElementById('delete-form').submit();"
                        class="btn"
                        style="background: rgba(239, 68, 68, 0.1); color: #ef4444; border: 1px solid rgba(239, 68, 68, 0.2);">Delete</button>
                </div>
            </form>

            <form id="delete-form" action="{{ route('admin.signals.destroy', $signal->id) }}" method="POST"
                style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
    </div>
</body>

</html>