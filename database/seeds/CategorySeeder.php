<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::insert([
            'name' => 'CAT I',
        ]);

        Category::insert([
            'name' => 'CAT II',
        ]);

        Category::insert([
            'name' => 'CAT III',
        ]);
    }
}
