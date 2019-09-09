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
            ['name' => 'PHP', 'description' => 'PHP'],
            ['name' => 'Laravel', 'description' => 'Laravel'],
            ['name' => 'Vue', 'description' => 'Vue'],
            ['name' => 'JS', 'description' => 'JS'],
            ['name' => 'CSS', 'description' => 'CSS'],
            ['name' => 'MacOS', 'description' => 'MacOS'],
            ['name' => 'Memcached', 'description' => 'Memcached'],
            ['name' => 'Redis', 'description' => 'Redis'],
            ['name' => 'MySQL', 'description' => 'MySQL'],
            ['name' => 'Git', 'description' => 'Git'],
            ['name' => 'Composer', 'description' => 'Composer'],
            ['name' => 'Packagist', 'description' => 'Packagist'],
            ['name' => 'UI', 'description' => 'UI'],

            ['name' => '肩', 'description' => '肩'],
            ['name' => '胸', 'description' => '胸'],
            ['name' => '背', 'description' => '背'],
            ['name' => '腿', 'description' => '腿'],
            ['name' => '二头', 'description' => '二头'],
            ['name' => '三头', 'description' => '三头'],
            ['name' => '腹', 'description' => '腹'],
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
