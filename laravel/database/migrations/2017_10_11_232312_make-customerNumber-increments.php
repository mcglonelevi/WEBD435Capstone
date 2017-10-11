<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class MakeCustomerNumberIncrements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::unprepared('ALTER TABLE `users` DROP FOREIGN KEY users_customernumber_foreign');
      DB::unprepared('ALTER TABLE `payments` DROP FOREIGN KEY payments_ibfk_1');
      DB::unprepared('ALTER TABLE `orders` DROP FOREIGN KEY orders_ibfk_1');
      DB::unprepared('ALTER TABLE `customers` MODIFY COLUMN customerNumber INT NOT NULL auto_increment');
      DB::unprepared('ALTER TABLE `orders` ADD FOREIGN KEY (customerNumber) REFERENCES customers(customerNumber)');
      DB::unprepared('ALTER TABLE `payments` ADD FOREIGN KEY (customerNumber) REFERENCES customers(customerNumber)');
      DB::unprepared('ALTER TABLE `users` ADD FOREIGN KEY (customerNumber) REFERENCES customers(customerNumber)');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
