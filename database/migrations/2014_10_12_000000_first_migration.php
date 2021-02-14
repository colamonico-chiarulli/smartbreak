<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class FirstMigration extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('classes', function(Blueprint $table){
            $table->id();
            $table->integer('year');
            $table->char('section', 1);
            $table->char('course', 3);
            $table->enum('site', ['colamonico', 'chiarulli']);
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 120);
            $table->string('last_name', 120);
            $table->string('email')->unique();
            $table->string('password');
            $table->enum('role', ['STUDENT', 'MANAGER', 'ADMIN'])->default('STUDENT');
            $table->rememberToken();

            $table->foreignId('class_id')->nullable();
            $table->foreign('class_id')->references('id')->on('classes');

            $table->timestamps();

        });

        Schema::create('categories', function(Blueprint $table){
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 128);
            $table->text('description')->nullable();
            $table->text('allergens')->nullable();
            $table->decimal('price', 6, 2);
            $table->integer('num_items');
            $table->integer('default_daily_stock');
            $table->string('photo_path')->nullable();

            $table->foreignId('category_id');
            $table->foreign('category_id')->references('id')->on('categories');

            $table->timestamps();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
        });

        Schema::create('order_product', function (Blueprint $table) {

            $table->integer('quantity')->default(1);
            $table->decimal('price', 6, 2);

            $table->foreignId('order_id');
            $table->foreign('order_id')->references('id')->on('orders');
            $table->foreignId('product_id');
            $table->foreign('product_id')->references('id')->on('products');

            $table->primary(['order_id', 'product_id']);

            $table->timestamps();

        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_product');
        Schema::dropIfExists('orders');
        Schema::dropIfExists('products');
        Schema::dropIfExists('categories');
        Schema::dropIfExists('users');
        Schema::dropIfExists('classes');
    }
}
