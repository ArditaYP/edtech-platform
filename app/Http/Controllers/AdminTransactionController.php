<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AdminTransactionController extends Controller
{
    /**
     * Display the transactions list for admin dashboard.
     */
    public function index(Request $request)
    {
        $query = Transaction::with(['user', 'course']);

        // Search logic (order_id, user name, or user email)
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('order_id', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        // Status filter logic
        if ($request->filled('status') && $request->input('status') !== 'all') {
            $query->where('status', $request->input('status'));
        }

        // Fetch paginated transactions (15 per page)
        $transactions = $query->latest()->paginate(15)->withQueryString();

        // Calculate summary statistics
        $totalRevenue = Transaction::where('status', 'paid')->sum('amount');
        $todayTransactionsCount = Transaction::whereDate('created_at', Carbon::today())->count();
        $pendingTransactionsCount = Transaction::where('status', 'pending')->count();

        return view('admin.transactions.index', compact(
            'transactions',
            'totalRevenue',
            'todayTransactionsCount',
            'pendingTransactionsCount'
        ));
    }
}
