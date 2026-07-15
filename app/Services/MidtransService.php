<?php

namespace App\Services;

use Midtrans\Config;
use Midtrans\Snap;

class MidtransService
{
    public function __construct()
    {
        // Set Merchant Server Key
        Config::$serverKey = config('midtrans.server_key');
        
        // Set Environment (default is false / Sandbox)
        Config::$isProduction = config('midtrans.is_production');
        
        // Set sanitization on
        Config::$isSanitized = config('midtrans.is_sanitized');
        
        // Set 3DS transaction for credit card
        Config::$is3ds = config('midtrans.is_3ds');
    }

    /**
     * Generate Snap Token for payment.
     *
     * @param array $params
     * @return string
     * @throws \Exception
     */
    public function getSnapToken(array $params): string
    {
        return Snap::getSnapToken($params);
    }
}
