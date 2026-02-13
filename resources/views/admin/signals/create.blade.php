<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Post New Signal - GSM Admin</title>
    <style>
        <?php echo file_get_contents(resource_path('css/app.css')); ?>

        body {
            background: var(--dark);
            color: var(--white);
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
        }

        input:focus {
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
    </style>
</head>

<body>
    <div class="container">
        <h2 style="margin-bottom: 2rem;">Post New Trading Signal 📈</h2>

        <div class="form-card">
            <form action="{{ route('admin.signals.store') }}" method="POST">
                @csrf

                <div class="row">
                    <div class="col">
                        <label>Symbol / Pair</label>
                        <input type="text" name="symbol" placeholder="e.g. BTCUSD or GOLD" required>
                    </div>
                    <div class="col">
                        <label>Type</label>
                        <select name="type">
                            <option value="BUY">BUY 🟢</option>
                            <option value="SELL">SELL 🔴</option>
                        </select>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Entry Price</label>
                        <input type="text" name="entry_price" placeholder="e.g. 96,500" required>
                    </div>
                    <div class="col">
                        <label>Stop Loss 🛑</label>
                        <input type="text" name="stop_loss" placeholder="e.g. 95,000"
                            style="border-color: rgba(239, 68, 68, 0.5);" required>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <label>Take Profit 1 🎯</label>
                        <input type="text" name="take_profit_1" placeholder="e.g. 97,000"
                            style="border-color: rgba(16, 185, 129, 0.5);" required>
                    </div>
                    <div class="col">
                        <label>Take Profit 2 (Optional)</label>
                        <input type="text" name="take_profit_2" placeholder="e.g. 98,500">
                    </div>
                    <div class="col">
                        <label>Take Profit 3 (Optional)</label>
                        <input type="text" name="take_profit_3" placeholder="e.g. 100,000">
                    </div>
                </div>

                <label>Analysis / Notes (Visible to Students)</label>
                <textarea name="notes" rows="3" placeholder="Main trend is bullish, entering on pullback..."></textarea>

                <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                    <a href="{{ route('admin.signals.index') }}" class="btn btn-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary" style="flex: 1;">Post Signal Now 🚀</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>