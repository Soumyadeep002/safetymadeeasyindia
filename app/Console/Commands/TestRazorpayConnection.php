<?php

namespace App\Console\Commands;

use App\Services\RazorpayService;
use Illuminate\Console\Command;

class TestRazorpayConnection extends Command
{
    protected $signature = 'razorpay:test';

    protected $description = 'Verify Razorpay API keys from .env can create a test order';

    public function handle(RazorpayService $razorpay): int
    {
        if (! $razorpay->isConfigured()) {
            $this->error('RAZORPAY_KEY and RAZORPAY_SECRET are missing in .env');

            return self::FAILURE;
        }

        $key = "rzp_live_SvS1LCNQE1pJj6";
        // $key = config('services.razorpay.key');
        $this->info('Key ID: '.substr($key, 0, 12).'...');

        try {
            $order = $razorpay->createOrder(10000, 'connect_test_'.time());
            $this->info('Connection OK. Test order created: '.$order['id']);

            return self::SUCCESS;
        } catch (\Exception $e) {
            $this->error('Connection failed: '.$e->getMessage());
            $this->newLine();
            $this->line('Fix: Razorpay Dashboard → Settings → API Keys');
            $this->line('  1. Regenerate Test keys (or use Live keys for production)');
            $this->line('  2. Copy Key ID → RAZORPAY_KEY');
            $this->line('  3. Copy Key Secret → RAZORPAY_SECRET');
            $this->line('  4. Run: php artisan config:clear');

            return self::FAILURE;
        }
    }
}
