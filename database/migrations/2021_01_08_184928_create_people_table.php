<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('document_number', 14)->unique();
            $table->string('cellphone', 11);
            $table->string('email', 150);
            $table->string('address', 150);
            $table->string('number', 10);
            $table->string('complement', 150)->nullable();
            $table->string('neighborhood', 100)->nullable();
            $table->string('zip_code', 8);
            $table->string('indicated_by', 100);
            $table->text('resume');
            $table->tinyInteger('terms_accepted');
            $table->tinyInteger('is_active')->default(false);
            $table->foreignId('city_id')->constrained();
            $table->foreignId('profile_id')->nullable()->constrained();
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
        Schema::dropIfExists('persons');
    }
}
