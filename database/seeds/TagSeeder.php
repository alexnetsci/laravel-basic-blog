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
            'name' => 'TAG 1',
        ]);

        Tag::insert([
            'name' => 'TAG 2',
        ]);

        Tag::insert([
            'name' => 'TAG 3',
        ]);
    }
}
