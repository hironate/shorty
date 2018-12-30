<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('links', function(Blueprint $table)
        {
            $table->engine = 'InnoDB';

            $table->increments('id');

            $table->string('short_url')->unique();;
            $table->longText('long_url');
            $table->string('ip');
            $table->string('creator')->nullable();
            $table->integer('clicks')->default(0);
            $table->string('secret_key')->nullable();
            
            $table->boolean('is_disabled')->default(0);
            $table->boolean('is_custom')->default(0);
            $table->boolean('is_api')->default(0);
            $table->string('long_url_hash', 10)->nullable();
            $table->index('long_url_hash', 'links_long_url_index');

            $table->index(
                ['created_at', 'creator', 'is_api'],
                'api_quota_index'
            );

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
        Schema::drop('links');
    }
}
