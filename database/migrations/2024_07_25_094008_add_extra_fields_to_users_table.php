<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('mobileno')->nullable()->after('remember_token');
            $table->string('projectname')->nullable()->after('mobileno');
            $table->string('city')->nullable()->after('projectname');
            $table->string('zipcode')->nullable()->after('city');
            $table->string('state')->nullable()->after('zipcode');
            $table->string('address')->nullable()->after('state');
            $table->string('type')->nullable()->after('address');  // or use ENUM if applicable
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'mobileno',
                'projectname',
                'city',
                'zipcode',
                'state',
                'address',
                'type',
            ]);
        });
    }
};
