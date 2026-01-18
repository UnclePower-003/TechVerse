<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HomeStat;

class HomeStatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        HomeStat::truncate();

        HomeStat::insert([
            [
                'quantity' => '10+ Years',
                'title' => 'Experience',
                'description' => 'Rapid on-site teams & Quality guarantee',
                'position' => 1,
            ],
            [
                'quantity' => '99.9%',
                'title' => 'Network Uptime',
                'description' => 'Across monitored sites',
                'position' => 2,
            ],
            [
                'quantity' => '50+',
                'title' => 'Major Deployments',
                'description' => '24/7 Support window with clear SLAs',
                'position' => 3,
            ],
        ]);
    }
}
