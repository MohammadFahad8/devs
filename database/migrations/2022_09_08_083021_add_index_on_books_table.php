<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        DB::statement("CREATE INDEX title_fulltext_idx ON books USING gin(to_tsvector('english', title))");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //In Laravel, the composer is a tool that includes all the dependencies and libraries.
        //  It helps the user to develop a project with respect to the mentioned framework.
        // Third-party libraries can be installed easily using composer.
        //  Composer is used to managing its dependencies and the dependencies are noted in composer.

    }
};
