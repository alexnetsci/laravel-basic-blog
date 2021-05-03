<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::insert([
            'name' => 'PHP',
        ]);

        Tag::insert([
            'name' => 'Laravel',
        ]);

        Tag::insert([
            'name' => 'mysql',
        ]);
    }
}
