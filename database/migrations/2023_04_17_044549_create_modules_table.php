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
        Schema::create('modules', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('resep_id');
            $table->string('title');
            $table->text('description');
            $table->enum("module_type",["file","youtube"]);
            $table->string("file_type")->nullable();
            $table->string("youtube")->nullable();
            $table->string("document")->nullable();
            $table->integer('order');
            $table->bigInteger('view')->default('0');
            $table->enum("status",["active","inactive"])->default("active");
            $table->foreign('resep_id')->references('id')->on('resep');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::table('modules',function(Blueprint $table){
            $table->dropForeign('modules_resep_id_foreign');
        });
        Schema::dropIfExists('modules');
    }
};