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
        Schema::create('transfers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('google_photos_media_id');
            $table->text('google_photos_base_url');
            $table->string('filename');
            $table->string('mime_type');
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('privacy_status')->default('private');
            $table->string('status')->default('pending');
            $table->string('youtube_video_id')->nullable();
            $table->text('error_message')->nullable();
            $table->unsignedBigInteger('file_size')->nullable();
            $table->timestamp('started_at')->nullable();
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transfers');
    }
};
