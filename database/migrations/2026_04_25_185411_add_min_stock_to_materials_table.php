<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('materials', function (Blueprint $table) {
            // Ngecek biar nggak error kalau kolomnya ternyata udah ada
            if (!Schema::hasColumn('materials', 'min_stock')) {
                // Tambahin kolom min_stock, defaultnya 10 biar aman
                $table->integer('min_stock')->default(10)->after('stock');
            }
        });
    }

    public function down()
    {
        Schema::table('materials', function (Blueprint $table) {
            $table->dropColumn('min_stock');
        });
    }
};
