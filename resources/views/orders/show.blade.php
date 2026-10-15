@extends('layouts.turismo')

@section('title', 'Pesanan ' . $order->code . ' | TURISMO')

@section('content')
@include('partials.page-header', ['eyebrow' => 'DETAIL PESANAN', 'title' => $order->code, 'sub' => $order->created_at->format('d M Y, H:i')])

<div class="max-w-4xl mx-auto px-6 py-14">

    <div class="grid sm:grid-cols-2 gap-6">
        <div class="bg-white border border-neutral-200 p-7">
            <p class="text-[10px] font-bold tracking-[0.25em] text-neutral-500 mb-3">PEMBELI</p>
            <p class="text-lg font-black">{{ $order->customer_name }}</p>
            <p class="text-sm mt-1">{{ $order->phone }}</p>
            <p class="text-sm text-neutral-600 mt-1">{{ $order->address }}</p>
        </div>
        <div class="bg-white border border-neutral-200 p-7">
            <p class="text-[10px] font-bold tracking-[0.25em] text-neutral-500 mb-3">STATUS PESANAN</p>
            <span class="inline-block bg-amber-100 text-amber-800 text-xs font-bold tracking-widest uppercase px-4 py-2">{{ $order->status }}</span>
            <p class="text-[10px] font-bold tracking-[0.25em] text-neutral-500 mt-6 mb-1">TOTAL</p>
            <p class="text-2xl font-black">{{ \App\Models\Product::rupiah($order->total) }}</p>
        </div>
    </div>

    <div class="overflow-x-auto bg-white border border-neutral-200 mt-6">
        <table class="w-full text-left">
            <thead class="bg-neutral-950 text-white text-[11px] tracking-widest">
                <tr>
                    <th class="p-5">MODEL</th>
                    <th class="p-5 text-right">HARGA</th>
                    <th class="p-5 text-right">QTY</th>
                    <th class="p-5 text-right">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($order->items as $item)
                    <tr class="border-t">
                        <td class="p-5 font-black uppercase">{{ $item->product_name }}</td>
                        <td class="p-5 text-right text-sm">{{ \App\Models\Product::rupiah($item->price) }}</td>
                        <td class="p-5 text-right text-sm">{{ $item->quantity }}</td>
                        <td class="p-5 text-right font-bold">{{ \App\Models\Product::rupiah($item->subtotal) }}</td>
                    </tr>
                @endforeach
            </tbody>
            <tfoot>
                <tr class="border-t-2 border-black bg-neutral-50">
                    <td colspan="3" class="p-5 text-right font-black tracking-widest text-sm">TOTAL</td>
                    <td class="p-5 text-right text-lg font-black">{{ \App\Models\Product::rupiah($order->total) }}</td>
                </tr>
            </tfoot>
        </table>
    </div>

    <div class="flex flex-wrap items-center gap-4 mt-10">
        <a href="{{ route('orders.print', $order) }}" target="_blank" class="btn btn-dark">CETAK STRUK</a>
        <a href="{{ route('orders.index') }}" class="text-xs font-bold tracking-widest text-neutral-500 hover:text-black">← SEMUA PESANAN</a>
    </div>
</div>
@endsection
