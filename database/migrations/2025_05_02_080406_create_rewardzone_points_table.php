<?php

use Obelaw\RewardZone\Base\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends BaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->prefix . 'points', function (Blueprint $table) {
            $table->id();
            $table->foreignId('profile_id')->nullable()->index()->constrained($this->prefix . 'profiles')->cascadeOnDelete();
            $table->integer('points')->default(0);
            $table->text('description')->nullable();
            $table->enum('type', ['credit', 'debit'])->default('credit');
            $table->date('expires_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'points');
    }
};
