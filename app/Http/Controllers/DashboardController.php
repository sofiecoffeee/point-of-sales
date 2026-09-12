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
        $today = today();

        $revenue = Order::whereData('created_at', $today)->sum('total_price');
        $transaction = Order::whereDate('created_at', $today)->count();
        $totalRefund = 0;
        $netIncome = $revenue - $totalRefund;

        return response()->json([
            'summary' => [
                'revenue' => $revenue,
                'net_income' => $netIncome,
                'total_refund' => $totalRefund,
                'transaction' => $transaction, 
            ]

        ]);
    }

  
}