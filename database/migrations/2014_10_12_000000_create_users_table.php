<?php

use App\Enums\ActivityLevel;
use App\Enums\Gender;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('password');
            $table->integer('weight');
            $table->integer('height');
            $table->integer('age');
            $table->integer('bmr');
            $table->integer('tdee');
            $table->enum('gender', [Gender::MALE->value, Gender::FEMALE->value]);
            $table->enum('activity_level', [
                ActivityLevel::SEDENTARY->value,
                ActivityLevel::LIGHTLY_ACTIVE->value,
                ActivityLevel::MODERATELY_ACTIVE->value,
                ActivityLevel::VERY_ACTIVE->value,
                ActivityLevel::EXTREMELY_ACTIVE->value,
            ]);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
