<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Obelaw\RewardZone\Base\BaseMigration;

return new class extends BaseMigration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create($this->prefix . 'profiles', function (Blueprint $table) {
            $table->id();
            $table->morphs(name: 'profileable');
            $table->unique(['profileable_id', 'profileable_type'], 'profileable_unique');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists($this->prefix . 'profiles');
    }
};
