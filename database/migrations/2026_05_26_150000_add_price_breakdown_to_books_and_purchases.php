<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->decimal('base_price', 10, 2)->default(0)->after('total_pages');
            $table->decimal('gst_percent', 5, 2)->default(18)->after('base_price');
            $table->decimal('gateway_charge_percent', 5, 2)->default(2)->after('gst_percent');
        });

        DB::table('books')->update([
            'base_price' => DB::raw('price'),
            'gst_percent' => 0,
            'gateway_charge_percent' => 0,
        ]);

        Schema::table('book_purchases', function (Blueprint $table) {
            $table->decimal('base_price', 10, 2)->nullable()->after('amount');
            $table->decimal('gst_percent', 5, 2)->nullable()->after('base_price');
            $table->decimal('gst_amount', 10, 2)->nullable()->after('gst_percent');
            $table->decimal('gateway_charge_percent', 5, 2)->nullable()->after('gst_amount');
            $table->decimal('gateway_charge_amount', 10, 2)->nullable()->after('gateway_charge_percent');
        });
    }

    public function down(): void
    {
        Schema::table('books', function (Blueprint $table) {
            $table->dropColumn(['base_price', 'gst_percent', 'gateway_charge_percent']);
        });

        Schema::table('book_purchases', function (Blueprint $table) {
            $table->dropColumn([
                'base_price',
                'gst_percent',
                'gst_amount',
                'gateway_charge_percent',
                'gateway_charge_amount',
            ]);
        });
    }
};
