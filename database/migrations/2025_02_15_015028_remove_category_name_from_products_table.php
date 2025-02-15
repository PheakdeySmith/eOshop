<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCategoryNameFromProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('category_name');  // Remove category_name column
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('category_name'); 
        });
    }
}
