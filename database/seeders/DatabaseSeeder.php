<?php

namespace Database\Seeders;

use App\Models\Vote;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Vote::firstOrCreate(['option_name' => 'Option A', 'vote_count' => 0]);
        Vote::firstOrCreate(['option_name' => 'Option B', 'vote_count' => 0]);

    }
}
