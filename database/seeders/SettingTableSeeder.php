<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Setting::insert([
            [
            'sitename'=>'Biratnagar City FC',
            'headerImage'=>'header.png',
            'footerImage'=>'footer.png',
            'facebook'=>'https://www.facebook.com/',
            'linkedin'=>'https://www.linkedin.com/',
            'twitter'=>'https://www.twitter.com/',
            'instagram'=>'https://www.instagram.com/',
            'aboutus'=>'Biratnagar City FC',
            'ourvalues'=>'Biratnagar City FC',
            'wordsfromcoach'=>'Biratnagar City FC',
            'ourvaluesimage'=>'header.png',
            'wordsfromcoachimage'=>'header.png',
            'address'=>'Ravi Bhawan-15, Kathmandu',
            'phone'=>'+977 01-4208209',
            'email'=>'info@biratnagarfc.com',
            'created_at' => date("Y-m-d H:i:s"),
            'updated_at' => date("Y-m-d H:i:s"),
            ],
        ]);
    }
}
