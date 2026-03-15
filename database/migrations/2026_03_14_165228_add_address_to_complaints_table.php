<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('complaints', function (Blueprint $table){
            if (Schema::hasColumn('complaints', 'address')){
                $table->dropColumn('address');
            }
            if (Schema::hasColumn('complaints', 'latitude')) {
                $table->dropColumn('latitude');
            }
            if (Schema::hasColumn('complaints', 'longitude')) {
                $table->dropColumn('longitude');
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('compliants', function (Blueprint $table) {
            $table->text('address')->nullable();
            $table->decimal('latitude', 10, 8)->nullable();
            $table->decimal('longitude', 11, 8)->nullable();
        });
    }
};
