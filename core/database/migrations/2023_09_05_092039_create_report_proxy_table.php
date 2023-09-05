<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('report_proxy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('report_id')->constrained();
            $table->foreignId('proxy_id')->constrained();
            $table->timestamp('checked_at')->nullable();
            $table->timestamp('failed_at')->nullable();
            $table->string('fail_error')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('report_proxy');
    }
};
