<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedCategoriesData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $categories = [
            [
                'name' => '编程',
                'description' => '编程'
            ],
            [
                'name' => '健身',
                'description' => '健身'
            ],
            [
                'name' => '其他',
                'description' => '其他'
            ],
        ];

        \DB::table('categories')->insert($categories);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        \DB::table('categories')->truncate();
    }
}
