<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisitorTable extends Migration
{

    const TABLE = 'visitor';
    const COLUMN_ID = 'id';
    const COLUMN_NAME = 'name';
    const COLUMN_PHONE = 'phone';
    const COLUMN_EMAIL = 'email';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigIncrements(self::COLUMN_ID);

            $table->string(self::COLUMN_NAME, 64);

            /**
             * It is an open numbering plan, however, imposing a maximum length of 15 digits to telephone numbers.
             */
            $table->string(self::COLUMN_PHONE, 15)->nullable();

            /**
             * That limit is a maximum of 64 characters (octets) in the "local part" (before the "@")
             * and a maximum of 255 characters (octets) in the domain part (after the "@")
             * for a total length of 320 characters.
             */
            $table->string(self::COLUMN_EMAIL, 320)->nullable();

            $table->unique([
                self::COLUMN_NAME,
                self::COLUMN_PHONE,
                self::COLUMN_EMAIL,
            ]);

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(self::TABLE);
    }
}
