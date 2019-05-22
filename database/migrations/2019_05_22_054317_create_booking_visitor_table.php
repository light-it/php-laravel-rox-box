<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBookingVisitorTable extends Migration
{

    const TABLE = 'booking_visitor';
    const COLUMN_ID = 'id';

    const COLUMN_BOOKING_ID = 'booking_id';
    const BOOKING_TABLE = 'booking';
    const BOOKING_PRIMARY_KEY = 'id';

    const COLUMN_VISITOR_ID = 'visitor_id';
    const VISITOR_TABLE = 'visitor';
    const VISITOR_PRIMARY_KEY = 'id';

    const COLUMN_PARENT_ID = 'parent_id';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigIncrements(self::COLUMN_ID);

            $table->unsignedBigInteger(self::COLUMN_BOOKING_ID);
            $table->foreign(self::COLUMN_BOOKING_ID)
                ->references(self::BOOKING_PRIMARY_KEY)
                ->on(self::BOOKING_TABLE);

            $table->unsignedBigInteger(self::COLUMN_VISITOR_ID);
            $table->foreign(self::COLUMN_VISITOR_ID)
                ->references(self::VISITOR_PRIMARY_KEY)
                ->on(self::VISITOR_TABLE);

            $table->unsignedBigInteger(self::COLUMN_PARENT_ID)->nullable();
            $table->foreign(self::COLUMN_PARENT_ID)
                ->references(self::COLUMN_ID)
                ->on(self::TABLE)
                ->onDelete('cascade');

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
