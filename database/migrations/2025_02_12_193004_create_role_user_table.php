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
        Schema::create('role_user', function (Blueprint $table) {
            //authorizable_id is id of user or any other model
            //authorizable_type is type of model (admin, staff ,etc)
            $table->morphs('authorizable');
            $table->foreignId('role_id')->constrained('roles')->cascadeOnDelete();

            $table->primary(['authorizable_id','authorizable_type','role_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('role_user');
    }
};
