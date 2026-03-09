<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // 1. Create the pivot table
        Schema::create('project_skill', function (Blueprint $table) {
            $table->foreignId('project_id')->constrained()->cascadeOnDelete();
            $table->foreignId('skill_id')->constrained()->cascadeOnDelete();
            $table->primary(['project_id', 'skill_id']);
        });

        // 2. If the old skill_id column still exists (upgrading from old schema),
        //    migrate existing relationships into the pivot table then drop it.
        if (Schema::hasColumn('projects', 'skill_id')) {
            DB::table('projects')
                ->whereNotNull('skill_id')
                ->get(['id', 'skill_id'])
                ->each(function ($project) {
                    DB::table('project_skill')->insertOrIgnore([
                        'project_id' => $project->id,
                        'skill_id'   => $project->skill_id,
                    ]);
                });

            Schema::table('projects', function (Blueprint $table) {
                $table->dropForeign(['skill_id']);
                $table->dropColumn('skill_id');
            });
        }

        // 3. Add description column if missing (upgrading from old schema)
        if (!Schema::hasColumn('projects', 'description')) {
            Schema::table('projects', function (Blueprint $table) {
                $table->string('description')->nullable()->after('name');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('project_skill');
    }
};