<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Struk {{ $order->code }}</title>

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            color: #111;
            margin: 0;
            background: #f3f3f3;
        }
        .sheet {
            max-width: 780px;
            margin: 24px auto;
            background: #fff;
            padding: 48px;
        }
        .head {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            border-bottom: 3px solid #111;
            padding-bottom: 20px;
        }
        .brand { font-size: 28px; font-weight: 900; letter-spacing: 0.3em; }
        .meta { text-align: right; font-size: 13px; line-height: 1.6; }
        .meta strong { font-size: 16px; }
        .grid {
            display: flex;
            gap: 40px;
            margin: 28px 0;
            font-size: 13px;
            line-height: 1.6;
        }
        .grid div { flex: 1; }
        .label {
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.15em;
            color: #777;
            margin-bottom: 4px;
        }
        table { width: 100%; border-collapse: collapse; font-size: 13px; }
        th {
            text-align: left;
            background: #111;
            color: #fff;
            padding: 10px;
            font-size: 11px;
            letter-spacing: 0.1em;
        }
        td { padding: 10px; border-bottom: 1px solid #ddd; }
        .r { text-align: right; }
        .total td {
            border-bottom: none;
            border-top: 2px solid #111;
            font-weight: 900;
            font-size: 15px;
        }
        .foot {
            margin-top: 40px;
            font-size: 12px;
            color: #666;
            text-align: center;
        }
        .actions { text-align: center; margin: 24px 0; }
        .actions button, .actions a {
            display: inline-block;
            background: #111;
            color: #fff;
            border: 0;
            padding: 14px 32px;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 0.15em;
            cursor: pointer;
            text-decoration: none;
            margin: 0 4px;
        }
        .actions a.light { background: #fff; color: #111; border: 1px solid #111; }

        @media print {
            body { background: #fff; }
            .sheet { margin: 0; padding: 0; max-width: none; }
            .actions { display: none; }
            @page { margin: 16mm; }
        }
    </style>
</head>
<body>

<div class="actions">
    <button onclick="window.print()">CETAK / SIMPAN PDF</button>
    <a href="{{ route('orders.show', $order) }}" class="light">KEMBALI</a>
</div>

<div class="sheet">
    <div class="head">
        <div class="brand">TURISMO</div>
        <div class="meta">
            <strong>{{ $order->code }}</strong><br>
            {{ $order->created_at->format('d M Y H:i') }}<br>
            Status: {{ strtoupper($order->status) }}
        </div>
    </div>

    <div class="grid">
        <div>
            <div class="label">PEMBELI</div>
            <strong>{{ $order->customer_name }}</strong><br>
            {{ $order->phone }}<br>
            {{ $order->address }}
        </div>
        <div>
            <div class="label">AKUN</div>
            {{ $order->user->name }}<br>
            {{ $order->user->email }}
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>#</th>
                <th>MODEL</th>
                <th class="r">HARGA</th>
                <th class="r">QTY</th>
                <th class="r">SUBTOTAL</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $i => $item)
                <tr>
                    <td>{{ $i + 1 }}</td>
                    <td>{{ strtoupper($item->product_name) }}</td>
                    <td class="r">{{ \App\Models\Product::rupiah($item->price) }}</td>
                    <td class="r">{{ $item->quantity }}</td>
                    <td class="r">{{ \App\Models\Product::rupiah($item->subtotal) }}</td>
                </tr>
            @endforeach
            <tr class="total">
                <td colspan="4" class="r">TOTAL</td>
                <td class="r">{{ \App\Models\Product::rupiah($order->total) }}</td>
            </tr>
        </tbody>
    </table>

    <div class="foot">
        Terima kasih telah berbelanja di TURISMO.<br>
        Dokumen ini dicetak pada {{ now()->format('d M Y H:i') }}.
    </div>
</div>

</body>
</html>