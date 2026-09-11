<?php

namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderDetails;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
   {
      $title = 'Dashboard';

   $title = "Dashboard";
   return view ('admin.dashboard', compact('title'));
   }

    public function data()
    {
        // Jumlah transaksi hari ini
        $todayTransaction = Order::whereDate('created_at', today())
            ->count();

        // Total income hari ini
        $todayIncome = Order::whereDate('created_at', today())
            ->sum('total_price');

        // Total quantity produk yang terjual hari ini
        $todayProduct = OrderDetails::whereHas('order', function ($query) {
            $query->whereDate('created_at', today());
        })->sum('qty');

        return response()->json([
            'today_transaction' => $todayTransaction,
            'today_income' => $todayIncome,
            'today_product' => $todayProduct,
        ]);
    }
  
}