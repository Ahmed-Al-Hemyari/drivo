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
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
           $table->string('name');
            $table->string('label_en')->nullable();
            $table->string('label_ar')->nullable();
            $table->string('type')->default(\App\Enums\PermissionTypes::CRUD->value);
            $table->boolean('ViewAny')->default(false);
            $table->boolean('View')->default(false);
            $table->boolean('Create')->default(false);
            $table->boolean('Replicate')->default(false);
            $table->boolean('Update')->default(false);
            $table->boolean('Delete')->default(false);
            $table->boolean('DeleteAny')->default(false);
            $table->boolean('Restore')->default(false);
            $table->boolean('RestoreAny')->default(false);
            $table->boolean('ForceDelete')->default(false);
            $table->boolean('ForceDeleteAny')->default(false);

            $table->foreignId('role_id')
                ->constrained('roles')
                ->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
