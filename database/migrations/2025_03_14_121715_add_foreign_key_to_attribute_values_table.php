<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->dropColumn('entity_id');
            $table->foreignId('entity_id')->constrained('projects')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('attribute_values', function (Blueprint $table) {
            $table->dropForeign(['entity_id']);
            $table->unsignedBigInteger('entity_id')->change();
        });
    }
};
