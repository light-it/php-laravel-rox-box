<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingTable extends Migration
{

    const TABLE = 'booking';
    const COLUMN_ID = 'id';
    const COLUMN_WORKSHOP_ID = 'workshop_id';
    const WORKSHOP_TABLE = 'workshop';
    const WORKSHOP_PRIMARY_KEY = 'id';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigIncrements(self::COLUMN_ID);

            $table->unsignedBigInteger(self::COLUMN_WORKSHOP_ID);
            $table->foreign(self::COLUMN_WORKSHOP_ID)
                ->references(self::WORKSHOP_PRIMARY_KEY)
                ->on(self::WORKSHOP_TABLE);

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
