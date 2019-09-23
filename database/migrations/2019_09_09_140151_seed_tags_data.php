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
            ['category_id' => 1, 'name' => 'PHP', 'description' => 'PHP', 'badge' => 'badge-primary'],
            ['category_id' => 1, 'name' => 'Laravel', 'description' => 'Laravel', 'badge' => 'badge-danger'],
            ['category_id' => 1, 'name' => 'Vue', 'description' => 'Vue', 'badge' => 'badge-success'],
            ['category_id' => 1, 'name' => 'JS', 'description' => 'JS', 'badge' => 'badge-danger'],
            ['category_id' => 1, 'name' => 'CSS', 'description' => 'CSS', 'badge' => 'badge-warning'],
            ['category_id' => 1, 'name' => 'MacOS', 'description' => 'MacOS', 'badge' => 'badge-primary'],
            ['category_id' => 1, 'name' => 'Memcached', 'description' => 'Memcached', 'badge' => 'badge-dark'],
            ['category_id' => 1, 'name' => 'Redis', 'description' => 'Redis', 'badge' => 'badge-secondary'],
            ['category_id' => 1, 'name' => 'MySQL', 'description' => 'MySQL', 'badge' => 'badge-warning'],
            ['category_id' => 1, 'name' => 'Git', 'description' => 'Git', 'badge' => 'badge-success'],
            ['category_id' => 1, 'name' => 'Composer', 'description' => 'Composer', 'badge' => 'badge-info'],
            ['category_id' => 1, 'name' => 'Packagist', 'description' => 'Packagist', 'badge' => 'badge-light'],
            ['category_id' => 1, 'name' => 'UI', 'description' => 'UI', 'badge' => 'badge-success'],

            ['category_id' => 2, 'name' => '肩', 'description' => '肩', 'badge' => 'badge-dark'],
            ['category_id' => 2, 'name' => '胸', 'description' => '胸', 'badge' => 'badge-success'],
            ['category_id' => 2, 'name' => '背', 'description' => '背', 'badge' => 'badge-warning'],
            ['category_id' => 2, 'name' => '腿', 'description' => '腿', 'badge' => 'badge-secondary'],
            ['category_id' => 2, 'name' => '二头', 'description' => '二头', 'badge' => 'badge-danger'],
            ['category_id' => 2, 'name' => '三头', 'description' => '三头', 'badge' => 'badge-info'],
            ['category_id' => 2, 'name' => '腹', 'description' => '腹', 'badge' => 'badge-primary'],
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
