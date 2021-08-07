<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupPortfolioPortfolioTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_portfolio_portfolio', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->foreignId('group_portfolio_id')
                ->references('id')
                ->on('groups_portfolios');
            
            $table->foreignId('portfolio_id')
                ->references('id')
                ->on('portfolios');
                
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
        Schema::dropIfExists('group_portfolio_portfolio');
    }
}
