<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUserCustomerFk extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('customerNumber');
        });
        Schema::table('users', function (Blueprint $table) {
            $table->foreign('customerNumber')->references('customerNumber')->on('customers');
        });
        DB::unprepared('ALTER TABLE `customers` DROP FOREIGN KEY customers_ibfk_1');
        Schema::table('customers', function (Blueprint $table) {
            $table->string('contactLastName')->nullable()->change();
            $table->string('contactFirstName')->nullable()->change();
            $table->string('creditLimit')->nullable()->change();
            $table->string('country')->nullable()->change();
            $table->dropColumn('salesRepEmployeeNumber');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
      Schema::table('users', function (Blueprint $table) {
          $table->dropColumn('customerNumber');
      });
    }
}
