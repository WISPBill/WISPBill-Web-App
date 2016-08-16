<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSoftDeleteToSsh extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasColumn('SSH_Credentials', 'deleted_at')) {
        // Nothing
        }else{
            Schema::table('SSH_Credentials', function ($table) {
            $table->softDeletes();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('SSH_Credentials', function ($table) {
        $table->dropColumn('deleted_at');
        });
    }
}
