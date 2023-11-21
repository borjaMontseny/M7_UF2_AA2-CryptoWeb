<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCryptocurrenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cryptocurrencies', function (Blueprint $table) {
            $table->integer('rank_id')->primary();
            $table->string('name');
            $table->string('symbol');
            $table->string('slug');
            $table->decimal('price', 20, 10);
<<<<<<< .merge_file_g32LqA
            $table->decimal('volume_change_1h', 20, 10)->nullable();
            $table->decimal('volume_change_24h', 20, 10)->nullable();
            $table->decimal('volume_change_7d', 20, 10)->nullable();
=======
            $table->decimal('percent_change_1h', 20, 10)->nullable();
            $table->decimal('percent_change_24h', 20, 10)->nullable();
            $table->decimal('percent_change_7d', 20, 10)->nullable();
>>>>>>> .merge_file_FtuuyO
            $table->bigInteger('market_cap')->nullable();
            $table->bigInteger('volume_24h')->nullable();
            $table->bigInteger('total_supply')->nullable();
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
        Schema::dropIfExists('cryptocurrencies');
    }
<<<<<<< .merge_file_g32LqA
}
=======
}
>>>>>>> .merge_file_FtuuyO
