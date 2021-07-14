<?php

namespace Database\Seeders;

use App\Models\TeamPosition;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class TeamPositionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        TeamPosition::insert([
            [
                'name' => 'Goalkeeper',
                'slug' => Str::slug('Goalkeeper'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Defender',
                'slug' => Str::slug('Defender'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Midfield',
                'slug' => Str::slug('Midfield'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
            [
                'name' => 'Forward',
                'slug' => Str::slug('Forward'),
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
