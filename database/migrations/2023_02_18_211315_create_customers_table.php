<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('username');
            $table->string('firstName')->nullable();
            $table->string('lastName')->nullable();
            $table->string('email')->nullable();
            $table->boolean('is_client')->default(false);
            $table->unsignedBigInteger('address_id');
            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
                ->onDelete('cascade');
            $table->unsignedBigInteger('profile_id');
            $table->foreign('profile_id')
                ->references('id')
                ->on('profiles')
                ->onDelete('cascade');
            $table->unsignedBigInteger('company_id');
            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
                ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
