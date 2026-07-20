<?php

use App\Models\BookPurchase;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('book_purchases', function (Blueprint $table) {
            $table->string('invoice_number')->nullable()->unique()->after('id');
        });

        BookPurchase::where('status', 'paid')
            ->whereNull('invoice_number')
            ->orderBy('id')
            ->each(function (BookPurchase $purchase) {
                $purchase->update([
                    'invoice_number' => BookPurchase::generateInvoiceNumber($purchase->id),
                ]);
            });
    }

    public function down(): void
    {
        Schema::table('book_purchases', function (Blueprint $table) {
            $table->dropColumn('invoice_number');
        });
    }
};
