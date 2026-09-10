<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
   public function index()
   {
      $title = 'Dashboard';

<<<<<<< HEAD
   $title = "Dashboard";
   return view ('admin.dashboard', compact('title'));
=======
      return view('admin.dashboard', compact('title'));
>>>>>>> 63814eacc7e76393231fbdcbd1e5f7bafe406b8f
   }
  
}