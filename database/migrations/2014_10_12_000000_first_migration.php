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
        Schema::create('sites', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('classes', function (Blueprint $table) {
            $table->id();
            $table->integer('year');
            $table->char('section', 1);
            $table->char('course', 3);
            $table->timestamps();
            $table->foreignId('site_id')->constrained('sites');
        });

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name', 120);
            $table->string('last_name', 120);
            $table->string('email')->unique();

            // $table->string('google_token')->nullable();
            // $table->string('google_avatar')->nullable();

            $table->string('password');
            $table->enum('role', ['STUDENT', 'MANAGER', 'ADMIN'])->default('STUDENT');
            $table->rememberToken();

            $table->foreignId('class_id')->on('classes')->nullable();
            $table->foreignId('site_id')->constrained('sites');
            $table->timestamps();
            // $table->softDeletes();
        });

        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
            // $table->softDeletes();
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

            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('site_id')->constrained('sites');

            $table->timestamps();
            // $table->softDeletes();
        });

        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users');
            $table->timestamps();
            // $table->softDeletes();
        });

        Schema::create('order_product', function (Blueprint $table) {
            $table->integer('quantity')->default(1);
            $table->decimal('price', 6, 2);

            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('order_id')->constrained('orders');

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
        Schema::dropIfExists('sites');
    }
}
