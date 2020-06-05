<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterContactsTable extends Migration
{
    public function up()
    {
      Schema::table('contacts',function(Blueprint $table){
        $table->unsignedBigInteger('company_id');
        $table->Foreign('company_id')
                  ->references('id')->on('companies');
      });
    }

    public function down()
    {
      Schema::table('contacts', function(Blueprint $table){
        $table->dropForeign('contacts_company_id_foreign');
        $table->dropColumn('company_id');
      });
    }
}
