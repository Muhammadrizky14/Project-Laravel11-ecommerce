<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        // Pertama, hapus kolom category yang lama
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category');
        });

        // Tambahkan category_id sebagai foreign key
        Schema::table('products', function (Blueprint $table) {
            $table->foreignId('category_id')
                  ->nullable()
                  ->after('name')
                  ->constrained('categories')
                  ->nullOnDelete();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
            $table->string('category')->nullable()->after('name');
        });
    }
};