<?php


namespace Kingsleyudenewu\AuditTrail\database\migrations;

use Illuminate\Database\Migrations\Migration;

class CreateAuditTrailTable extends Migration
{
    public function up()
    {
        Schema::create('audit_trails', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('user_id')->unsigned();
            $table->foreign("user_id")->references("id")->on("users")->onDelete("restrict");
            $table->string('comment')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('audit_trails');
    }
}
