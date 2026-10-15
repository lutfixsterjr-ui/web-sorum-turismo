<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\View\View;

class OrderController extends Controller
{
    public function index(): View
    {
        $orders = auth()->user()
            ->orders()
            ->withCount('items')
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'customer_name' => ['required', 'string', 'max:255'],
            'phone'         => ['required', 'string', 'max:20'],
            'address'       => ['required', 'string', 'max:500'],
        ]);

        $cart = session('cart', []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Keranjang masih kosong.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get();

        if ($products->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Produk di keranjang tidak ditemukan.');
        }

        $order = DB::transaction(function () use ($data, $cart, $products) {
            $total = $products->sum(fn ($p) => $p->price * $cart[$p->id]);

            $order = Order::create([
                'user_id'       => auth()->id(),
                'code'          => 'TRM-' . now()->format('Ymd') . '-' . strtoupper(Str::random(5)),
                'customer_name' => $data['customer_name'],
                'phone'         => $data['phone'],
                'address'       => $data['address'],
                'total'         => $total,
                'status'        => 'pending',
            ]);

            foreach ($products as $p) {
                $qty = $cart[$p->id];

                $order->items()->create([
                    'product_id'   => $p->id,
                    'product_name' => $p->name,
                    'price'        => $p->price,
                    'quantity'     => $qty,
                    'subtotal'     => $p->price * $qty,
                ]);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()
            ->route('orders.show', $order)
            ->with('success', 'Pesanan berhasil dibuat. Kode: ' . $order->code);
    }

    public function show(Order $order): View
    {
        $this->authorizeOrder($order);
        $order->load('items');

        return view('orders.show', compact('order'));
    }

    public function print(Order $order): View
    {
        $this->authorizeOrder($order);
        $order->load('items');

        return view('orders.print', compact('order'));
    }

    private function authorizeOrder(Order $order): void
    {
        abort_unless(
            $order->user_id === auth()->id() || auth()->user()->is_admin,
            403
        );
    }
}