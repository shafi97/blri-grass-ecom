<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('category_id')->constrained()->cascadeOnDelete();
            $table->foreignId('sub_category_id')->constrained()->cascadeOnDelete();
            $table->string('tran_id',64);
            $table->tinyInteger('type')->comment('1=in stock, 2=sale');
            $table->string('name',255);
            $table->string('weight',32)->nullable();
            $table->date('d_o_b')->nullable();
            $table->string('size',191)->nullable();
            $table->string('color',191)->nullable();
            $table->integer('quantity')->nullable();
            $table->decimal('price',14,2)->nullable();
            $table->decimal('discount',14,2)->default(0)->nullable();
            $table->string('product_code',191)->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
