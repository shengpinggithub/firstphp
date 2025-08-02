<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEmailTitleWageToUserTable extends Migration
{
    public function up(): void
    {
Schema::table('user', function (Blueprint $table) {
    $table->string('email')->nullable()->unique()->after('id');
    $table->string('title')->nullable()->after('email');
    $table->decimal('wage', 8, 2)->nullable()->after('title');
});
    }

    public function down(): void
    {
        Schema::table('user', function (Blueprint $table) {
            $table->dropColumn(['email', 'title', 'wage']);
        });
    }
}
