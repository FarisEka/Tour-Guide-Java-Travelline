<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard', [
    'totalGuides' => 120,
    'pendingGuides' => 15,
    'verifiedGuides' => 105,
    'totalBookings' => 42,
    'latestGuides' => [
        (object)['name' => 'Agus Santoso', 'phone' => '081234567890', 'status' => 'pending'],
        (object)['name' => 'Rina Widya', 'phone' => '089876543210', 'status' => 'verified'],
    ],
]);
    }
}
