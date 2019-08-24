<?php

use App\Models\Tags;
use Illuminate\Database\Seeder;

/**
 * Class TagsTableSeeder
 */
class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Tags::create(['section' => 'lease', 'name' => 'Bevestigd']);
        Tags::create(['section' => 'lease', 'name' => 'Optie']);
        Tags::create(['section' => 'lease', 'name' => 'Nieuwe aanvraag']);
    }
}
