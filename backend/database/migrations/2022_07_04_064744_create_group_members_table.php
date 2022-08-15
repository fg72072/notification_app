<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGroupMembersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('group_members', function (Blueprint $table) {
            $table->id();
            $table->string('group_id');
            $table->string('user_id');
            $table->string('remove_by_id')->default(0)->nullable();
            $table->string('is_admin')->enum(['0','1'])->default('0')->nullable();
            $table->string('left_at')->nullable();
            $table->string('remove_at')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('group_members');
    }
}
