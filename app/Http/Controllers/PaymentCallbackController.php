<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\Enrollment;
use Illuminate\Http\Request;

class PaymentCallbackController extends Controller
{
    /**
     * Handle Midtrans Payment Notification Webhook.
     */
    public function handle(Request $request)
    {
        $orderId = $request->input('order_id');
        $statusCode = $request->input('status_code');
        $grossAmount = $request->input('gross_amount');
        $signatureKey = $request->input('signature_key');
        $transactionStatus = $request->input('transaction_status');
        $paymentType = $request->input('payment_type');

        // 1. Verify Signature Key
        $serverKey = config('midtrans.server_key');
        $localSignature = hash('sha512', $orderId . $statusCode . $grossAmount . $serverKey);

        if ($localSignature !== $signatureKey) {
            return response()->json([
                'status' => 'error',
                'message' => 'Invalid signature key'
            ], 403);
        }

        // 2. Find associated Transaction
        $transaction = Transaction::where('order_id', $orderId)->first();

        if (!$transaction) {
            return response()->json([
                'status' => 'error',
                'message' => 'Transaction not found'
            ], 404);
        }

        // 3. Handle payment status updates
        if ($transactionStatus === 'capture' || $transactionStatus === 'settlement') {
            // Update Transaction Status
            $transaction->update([
                'status' => 'paid',
                'payment_type' => $paymentType
            ]);

            // Create Active Student Enrollment
            Enrollment::firstOrCreate([
                'user_id' => $transaction->user_id,
                'course_id' => $transaction->course_id,
            ], [
                'status' => 'active'
            ]);

        } elseif ($transactionStatus === 'pending') {
            $transaction->update([
                'status' => 'pending',
                'payment_type' => $paymentType
            ]);

        } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
            $transaction->update([
                'status' => 'failed',
                'payment_type' => $paymentType
            ]);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Callback handled successfully'
        ], 200);
    }
}
