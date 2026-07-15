<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Transaction;
use App\Services\MidtransService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Exception;

class CheckoutController extends Controller
{
    protected $midtransService;

    public function __construct(MidtransService $midtransService)
    {
        $this->midtransService = $midtransService;
    }

    public function process(Request $request, Course $course)
    {
        $user = Auth::user();

        // 1. Check if user is already enrolled in this course
        $isEnrolled = $user->enrollments()
            ->where('course_id', $course->id)
            ->where('status', 'active')
            ->exists();

        if ($isEnrolled) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Anda sudah memiliki kelas ini.');
        }

        // 2. Generate unique order ID
        $orderId = 'EDU-' . time() . '-' . $user->id;

        // 3. Prepare Midtrans parameters
        $params = [
            'transaction_details' => [
                'order_id' => $orderId,
                'gross_amount' => (int) $course->price,
            ],
            'item_details' => [
                [
                    'id' => (string) $course->id,
                    'price' => (int) $course->price,
                    'quantity' => 1,
                    'name' => substr($course->title, 0, 50),
                ]
            ],
            'customer_details' => [
                'first_name' => $user->name,
                'email' => $user->email,
            ]
        ];

        try {
            // 4. Request Snap Token from Midtrans Service
            $snapToken = $this->midtransService->getSnapToken($params);

            // 5. Create Transaction record in DB
            $transaction = Transaction::create([
                'order_id' => $orderId,
                'user_id' => $user->id,
                'course_id' => $course->id,
                'amount' => $course->price,
                'status' => 'pending',
                'snap_token' => $snapToken,
            ]);

            // 6. Return the checkout view page
            return view('checkout.show', compact('snapToken', 'transaction', 'course'));

        } catch (Exception $e) {
            return redirect()->route('courses.show', $course->slug)
                ->with('error', 'Gagal memproses transaksi: ' . $e->getMessage());
        }
    }

    /**
     * Simulate local checkout success for sandbox/localhost environment.
     */
    public function simulateSuccess(Request $request)
    {
        $orderId = $request->input('order_id');
        $transaction = Transaction::where('order_id', $orderId)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        // Update Transaction status
        $transaction->update([
            'status' => 'paid',
            'payment_type' => 'simulation'
        ]);

        // Create Active Student Enrollment
        \App\Models\Enrollment::firstOrCreate([
            'user_id' => $transaction->user_id,
            'course_id' => $transaction->course_id,
        ], [
            'status' => 'active'
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Local enrollment created successfully'
        ]);
    }
}
