<?php

use App\Models\Advert;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBidsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bids', function (Blueprint $table) {
            $table->foreignIdFor(Advert::class, 'advert');
            $table->foreignIdFor(User::class, 'bidder');
            $table->float('amount');
            $table->index(['advert', 'bidder']);
            $table->timestamps();
            $table->softDeletes()->nullable();
            $table->foreignIdFor(User::class, 'deleted_by')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bids');
    }
}
