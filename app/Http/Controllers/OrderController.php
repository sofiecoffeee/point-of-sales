<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Midtrans\Config;
use Midtrans\Snap;

use App\Models\Product;
use RuntimeException;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('orderDetails.product')->latest()->get();
        $title = "Order Management";

        return view('admin.orders.index', compact('title', 'orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = \App\Models\Category::get();
        $products = Product::with('category')->orderBy('id')->get();
        $title = "Create New Order";
        return view('admin.orders.create', compact( 'title',
        'categories',
        'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'items' => ['required', 'array', 'min:1'],
            'items.*.id' => ['required', 'integer', 'exists:products,id'],
            'items.*.qty' => ['required', 'integer', 'min:1'],
            'payment_method' => ['required', 'string', 'in:cash,midtrans'],
            'customer_name' => ['nullable', 'string', 'max:255'],
        ]);

        try {
            $order = DB::transaction(function () use ($validated) {
                $subtotal = 0;
                $itemsData = [];

                foreach ($validated['items'] as $item) {
                    $product = Product::query()->lockForUpdate()->findOrFail($item['id']);
                    $quantity = $item['qty'];

                    if ($product->stock < $quantity) {
                        throw new RuntimeException("Stok produk '{$product->name}' tidak mencukupi.");
                    }

                    $itemSubtotal = $product->price * $quantity;
                    $subtotal += $itemSubtotal;
                    $itemsData[] = compact('product', 'quantity', 'itemSubtotal');
                }

                $total = (int) round($subtotal * 1.11);
                $paymentMethod = $validated['payment_method'] === 'midtrans' ? 1 : 0;

                $order = Order::create([
                    'user_id' => Auth::id(),
                    'order_number' => 'ORD-' . now()->format('YmdHis') . '-' . random_int(1000, 9999),
                    'total_price' => $total,
                    'change' => 0,
                    'payment_method' => $paymentMethod,
                    'payment_status' => $paymentMethod === 0 ? 1 : 0,
                    'snap_token' => null,
                ]);

                foreach ($itemsData as $data) {
                    OrderDetails::create([
                        'order_id' => $order->id,
                        'product_id' => $data['product']->id,
                        'qty' => $data['quantity'],
                        'unit_price' => $data['product']->price,
                        'subtotal' => $data['itemSubtotal'],
                    ]);

                    $data['product']->decrement('stock', $data['quantity']);
                }

                return $order;
            });

            if ($validated['payment_method'] === 'midtrans') {
                if (!class_exists(Config::class) || !class_exists(Snap::class)) {
                    throw new RuntimeException('Midtrans SDK belum terinstall atau dikonfigurasi dengan benar.');
                }

                Config::$serverKey = config('midtrans.server_key');
                Config::$isProduction = config('midtrans.is_production');
                Config::$isSanitized = config('midtrans.is_sanitized', true);
                Config::$is3ds = config('midtrans.is_3ds', true);

                $snapToken = Snap::getSnapToken([
                    'transaction_details' => [
                        'order_id' => $order->order_number,
                        'gross_amount' => $order->total_price,
                    ],
                    'customer_details' => [
                        'first_name' => $validated['customer_name'] ?? 'Customer',
                    ],
                    'enabled_payments' => ['gopay', 'qris'],
                ]);

                $order->update(['snap_token' => $snapToken]);

                return response()->json([
                    'success' => true,
                    'payment_method' => 'midtrans',
                    'snap_token' => $snapToken,
                    'order_id' => $order->id,
                ]);
            }

            return response()->json([
                'success' => true,
                'payment_method' => 'cash',
                'order_id' => $order->id,
            ]);
        } catch (\Throwable $exception) {
            return response()->json([
                'success' => false,
                'message' => 'GAGAL MENYIMPAN TRANSAKSI! ' . $exception->getMessage(),
            ], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
