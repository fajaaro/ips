<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('course_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('bundle_id')->nullable()->constrained()->onDelete('cascade');
            $table->string('invoice_number', 20);
            $table->decimal('total_price', 12, 2);
            $table->enum('payment_status', ['paid', 'unpaid'])->default('unpaid');
            $table->timestamps();
            $table->timestamp('paid_at', 0)->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
}
