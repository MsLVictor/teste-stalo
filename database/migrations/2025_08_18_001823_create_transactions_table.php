<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('transactions', function (Blueprint $table) {
            $table->id();
            $table->decimal('valor', 10, 2);
            $table->text('description')->nullable(); // Optional description field
            $table->softDeletes(); // Necessary for soft delete
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('transactions');
    }
};
