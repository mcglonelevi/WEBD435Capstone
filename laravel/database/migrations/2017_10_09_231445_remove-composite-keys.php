<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

class RemoveCompositeKeys extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      DB::unprepared('ALTER TABLE `payments` DROP FOREIGN KEY payments_ibfk_1');
      DB::unprepared('ALTER TABLE `payments` DROP PRIMARY KEY, ADD `id` INT PRIMARY KEY AUTO_INCREMENT');
      DB::unprepared('ALTER TABLE `payments` ADD FOREIGN KEY (customerNumber) REFERENCES customers(customerNumber)');

      DB::unprepared('ALTER TABLE `orderdetails` DROP FOREIGN KEY orderdetails_ibfk_1');
      DB::unprepared('ALTER TABLE `orderdetails` DROP FOREIGN KEY orderdetails_ibfk_2');
      DB::unprepared('ALTER TABLE `orderdetails` DROP PRIMARY KEY, ADD `id` INT PRIMARY KEY AUTO_INCREMENT');
      DB::unprepared('ALTER TABLE `orderdetails` ADD FOREIGN KEY (orderNumber) REFERENCES orders(orderNumber)');
      DB::unprepared('ALTER TABLE `orderdetails` ADD FOREIGN KEY (productCode) REFERENCES products(productCode)');
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
