<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('payment_attempts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('order_id')->constrained()->cascadeOnDelete();
            $table->string('gateway')->default('ekpay');
            $table->string('gateway_transaction_id')->nullable(); // trnx_id / application_no
            $table->string('secure_token')->nullable();
            $table->decimal('amount', 12, 2);
            $table->string('status', 20)->default('initiated'); // initiated, success, failed
            $table->json('raw_response')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void {
        Schema::dropIfExists('payment_attempts');
    }
};
