<?php

use App\Models\Workshop;

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWorkshopTable extends Migration
{

    const TABLE = 'workshop';
    const COLUMN_ID = 'id';
    const COLUMN_DT_START = 'dt_start';
    const COLUMN_DT_END = 'dt_end';
    const COLUMN_MAX_VISITORS = 'max_visitors';

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(self::TABLE, function (Blueprint $table) {
            $table->bigIncrements(self::COLUMN_ID);

            $table->dateTime(self::COLUMN_DT_START);
            $table->dateTime(self::COLUMN_DT_END);
            $table->unsignedInteger(self::COLUMN_MAX_VISITORS);

            $table->unique([
                self::COLUMN_DT_START,
                self::COLUMN_DT_END,
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
