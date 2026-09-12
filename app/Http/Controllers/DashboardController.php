<?php

namespace App\Http\Controllers;
use App\Models\Order;
use Carbon\Carbon;


use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index(Request $request)
   {

    $title = "Dashboard";

    $startDate = $request->input('start_date', now()->startOfMonth()->format('Y-m-d'));
    $endDate = $request->input('end_date', now()->endOfMonth()->format('Y-m-d'));

    $revenue = Order::whereBetween('created_at', [
        Carbon::parse($startDate)->startOfDay(),
        Carbon::parse($endDate)->endOfDay(),
    ])->sum('total_price');

    $transaction = Order::whereBetween('created_at', [
        Carbon::parse($startDate)->startOfDay(),
        Carbon::parse($endDate)->endOfDay(),
    ])->count();
    $totalRefund = 0;
    $netIncome = $revenue - $totalRefund;
  
    
    return view ('admin.dashboard', compact('title', 'startDate', 'endDate', 'revenue', 'transaction', 'totalRefund', 'netIncome' ));
   }
}