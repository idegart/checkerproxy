<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('proxies', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained();
            $table->ipAddress();
            $table->string('protocol')->nullable();
            $table->string('country')->nullable();
            $table->string('speed')->nullable();
            $table->timestamps();
            $table->timestamp('completed_at')->nullable();

            $table->unique(['report_id', 'ip_address']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('proxies');
    }
};
