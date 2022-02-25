<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Tag::create(['name' => 'Web Development']);
        Tag::create(['name' => 'Laravel']);
        Tag::create(['name' => 'Web 3']);
    }
}
