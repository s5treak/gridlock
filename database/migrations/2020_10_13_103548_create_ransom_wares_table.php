<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRansomWaresTable extends Migration
{
    /**
     * Run the migrations.
     * 
     * @return void
     */
    public function up()
    {
        Schema::create('ransom_wares', function (Blueprint $table) {
            $table->id();
            $table->string('device_type');
            $table->text('publicIp');
            $table->string('os');
            $table->text('enc_fernet_key')->nullable();
            $table->text('publickey');
            $table->text('privatekey');
            $table->BigInteger('isPaid')->default(0);
            $table->BigInteger('is_encrypted')->default(0);
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
        Schema::dropIfExists('ransom_wares');
    }
}
