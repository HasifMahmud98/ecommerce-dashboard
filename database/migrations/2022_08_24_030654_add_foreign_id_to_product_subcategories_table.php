<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignIdToProductSubcategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('product_subcategories', function (Blueprint $table) {
            
            $table->foreign('subcategory_id')->references('id')->on('subcategories');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('product_subcategories', function (Blueprint $table) {
            
            // $table->dropForeign('subcategory_id');
            // $table->dropForeign('product_id');
        });
    }
}