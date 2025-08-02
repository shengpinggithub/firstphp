<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameUserNamesTable extends Migration
{
    public function up(): void
    {
        DB::statement('ALTER TABLE user_names RENAME TO user');
    }

    public function down(): void
    {
        DB::statement('ALTER TABLE user RENAME TO user_names');
    }
}
