<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedTagsData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $tags = [
            ['name' => 'PHP', 'description' => 'PHP', 'badge' => 'badge-primary'],
            ['name' => 'Laravel', 'description' => 'Laravel', 'badge' => 'badge-danger'],
            ['name' => 'Vue', 'description' => 'Vue', 'badge' => 'badge-success'],
            ['name' => 'JS', 'description' => 'JS', 'badge' => 'badge-danger'],
            ['name' => 'CSS', 'description' => 'CSS', 'badge' => 'badge-warning'],
            ['name' => 'MacOS', 'description' => 'MacOS', 'badge' => 'badge-primary'],
            ['name' => 'Memcached', 'description' => 'Memcached', 'badge' => 'badge-dark'],
            ['name' => 'Redis', 'description' => 'Redis', 'badge' => 'badge-secondary'],
            ['name' => 'MySQL', 'description' => 'MySQL', 'badge' => 'badge-warning'],
            ['name' => 'Git', 'description' => 'Git', 'badge' => 'badge-success'],
            ['name' => 'Composer', 'description' => 'Composer', 'badge' => 'badge-info'],
            ['name' => 'Packagist', 'description' => 'Packagist', 'badge' => 'badge-light'],
            ['name' => 'UI', 'description' => 'UI', 'badge' => 'badge-success'],

            ['name' => '肩', 'description' => '肩', 'badge' => 'badge-dark'],
            ['name' => '胸', 'description' => '胸', 'badge' => 'badge-success'],
            ['name' => '背', 'description' => '背', 'badge' => 'badge-warning'],
            ['name' => '腿', 'description' => '腿', 'badge' => 'badge-secondary'],
            ['name' => '二头', 'description' => '二头', 'badge' => 'badge-danger'],
            ['name' => '三头', 'description' => '三头', 'badge' => 'badge-info'],
            ['name' => '腹', 'description' => '腹', 'badge' => 'badge-primary'],
        ];

        \DB::table('tags')->insert($tags);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('tags')->truncate();
    }
}
