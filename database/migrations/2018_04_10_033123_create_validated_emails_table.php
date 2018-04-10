<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateValidatedEmailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('validated_emails', function (Blueprint $table) {
            $table->increments('id');
            // By IETF, the max allowed limit of email length is {64}@{255}
            // but a custom-defined limit can increase our app's security & performance
            $table->string('email', 100)->unique();
            $table->timestamp('validated_timestamp')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('validated_emails');
    }
}
