<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ServerCategory;
use App\Models\ServerComponent;

class ServerBuilderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create Categories
        $categories = [
            [
                'name' => 'Processor',
                'slug' => 'processor',
                'description' => 'Server-grade CPUs for high-performance computing',
                'required' => true,
                'sort_order' => 1,
            ],
            [
                'name' => 'Motherboard',
                'slug' => 'motherboard',
                'description' => 'Enterprise server motherboards',
                'required' => true,
                'sort_order' => 2,
            ],
            [
                'name' => 'RAM',
                'slug' => 'ram',
                'description' => 'ECC memory for server reliability',
                'required' => true,
                'sort_order' => 3,
            ],
            [
                'name' => 'Storage',
                'slug' => 'storage',
                'description' => 'Enterprise-grade storage solutions',
                'required' => true,
                'sort_order' => 4,
            ],
            [
                'name' => 'Power Supply',
                'slug' => 'power-supply',
                'description' => 'Redundant power supplies for reliability',
                'required' => true,
                'sort_order' => 5,
            ],
            [
                'name' => 'Chassis',
                'slug' => 'chassis',
                'description' => 'Rackmount server chassis',
                'required' => true,
                'sort_order' => 6,
            ],
            [
                'name' => 'Network Card',
                'slug' => 'network-card',
                'description' => 'High-speed network adapters',
                'required' => false,
                'sort_order' => 7,
            ],
            [
                'name' => 'RAID Controller',
                'slug' => 'raid-controller',
                'description' => 'Hardware RAID controllers',
                'required' => false,
                'sort_order' => 8,
            ],
        ];

        foreach ($categories as $categoryData) {
            $category = ServerCategory::create($categoryData);

            // Add components based on category
            switch ($category->slug) {
                case 'processor':
                    $this->seedProcessors($category->id);
                    break;
                case 'motherboard':
                    $this->seedMotherboards($category->id);
                    break;
                case 'ram':
                    $this->seedRAM($category->id);
                    break;
                case 'storage':
                    $this->seedStorage($category->id);
                    break;
                case 'power-supply':
                    $this->seedPowerSupplies($category->id);
                    break;
                case 'chassis':
                    $this->seedChassis($category->id);
                    break;
                case 'network-card':
                    $this->seedNetworkCards($category->id);
                    break;
                case 'raid-controller':
                    $this->seedRaidControllers($category->id);
                    break;
            }
        }
    }

    private function seedProcessors($categoryId)
    {
        $processors = [
            [
                'name' => 'Intel Xeon Gold 6348',
                'description' => '28-Core, 2.6GHz Base, 56 Threads',
                'price' => 285000,
                'image_url' => 'https://images.unsplash.com/photo-1555617981-dac3880eac6e?w=400',
                'specifications' => [
                    'cores' => 28,
                    'threads' => 56,
                    'base_clock' => '2.6 GHz',
                    'turbo_clock' => '3.5 GHz',
                    'tdp' => '235W',
                ],
                'sort_order' => 1,
            ],
            [
                'name' => 'AMD EPYC 7763',
                'description' => '64-Core, 2.45GHz Base, 128 Threads',
                'price' => 425000,
                'image_url' => 'https://images.unsplash.com/photo-1555617981-dac3880eac6e?w=400',
                'specifications' => [
                    'cores' => 64,
                    'threads' => 128,
                    'base_clock' => '2.45 GHz',
                    'turbo_clock' => '3.5 GHz',
                    'tdp' => '280W',
                ],
                'sort_order' => 2,
            ],
            [
                'name' => 'Intel Xeon Silver 4314',
                'description' => '16-Core, 2.4GHz Base, 32 Threads',
                'price' => 145000,
                'image_url' => 'https://images.unsplash.com/photo-1555617981-dac3880eac6e?w=400',
                'specifications' => [
                    'cores' => 16,
                    'threads' => 32,
                    'base_clock' => '2.4 GHz',
                    'turbo_clock' => '3.4 GHz',
                    'tdp' => '135W',
                ],
                'sort_order' => 3,
            ],
        ];

        foreach ($processors as $processor) {
            ServerComponent::create(array_merge(['category_id' => $categoryId], $processor));
        }
    }

    private function seedMotherboards($categoryId)
    {
        $motherboards = [
            [
                'name' => 'Supermicro X12DPi-N6',
                'description' => 'Dual Socket LGA4189, 16 DIMM slots',
                'price' => 95000,
                'image_url' => 'https://images.unsplash.com/photo-1587202372616-b43abea06c2a?w=400',
                'specifications' => [
                    'socket' => 'Dual LGA4189',
                    'ram_slots' => 16,
                    'max_ram' => '4TB',
                    'form_factor' => 'EEB',
                ],
                'sort_order' => 1,
            ],
            [
                'name' => 'ASUS KRPA-U16',
                'description' => 'Dual Socket SP3, 16 DIMM slots',
                'price' => 88000,
                'image_url' => 'https://images.unsplash.com/photo-1587202372616-b43abea06c2a?w=400',
                'specifications' => [
                    'socket' => 'Dual SP3',
                    'ram_slots' => 16,
                    'max_ram' => '4TB',
                    'form_factor' => 'EEB',
                ],
                'sort_order' => 2,
            ],
        ];

        foreach ($motherboards as $motherboard) {
            ServerComponent::create(array_merge(['category_id' => $categoryId], $motherboard));
        }
    }

    private function seedRAM($categoryId)
    {
        $ramModules = [
            [
                'name' => 'Samsung 32GB DDR4 ECC REG 3200MHz',
                'description' => 'Per Module - Select quantity based on needs',
                'price' => 18500,
                'image_url' => 'https://images.unsplash.com/photo-1541348263662-e068662d82af?w=400',
                'specifications' => [
                    'capacity' => '32GB',
                    'type' => 'DDR4 ECC Registered',
                    'speed' => '3200MHz',
                ],
                'sort_order' => 1,
            ],
            [
                'name' => 'Micron 64GB DDR4 ECC REG 3200MHz',
                'description' => 'Per Module - Select quantity based on needs',
                'price' => 35000,
                'image_url' => 'https://images.unsplash.com/photo-1541348263662-e068662d82af?w=400',
                'specifications' => [
                    'capacity' => '64GB',
                    'type' => 'DDR4 ECC Registered',
                    'speed' => '3200MHz',
                ],
                'sort_order' => 2,
            ],
            [
                'name' => 'Kingston 128GB DDR4 ECC LRDIMM 3200MHz',
                'description' => 'Per Module - High capacity load-reduced',
                'price' => 68000,
                'image_url' => 'https://images.unsplash.com/photo-1541348263662-e068662d82af?w=400',
                'specifications' => [
                    'capacity' => '128GB',
                    'type' => 'DDR4 ECC LRDIMM',
                    'speed' => '3200MHz',
                ],
                'sort_order' => 3,
            ],
        ];

        foreach ($ramModules as $ram) {
            ServerComponent::create(array_merge(['category_id' => $categoryId], $ram));
        }
    }

    private function seedStorage($categoryId)
    {
        $storageOptions = [
            [
                'name' => 'Samsung PM9A3 960GB NVMe SSD',
                'description' => 'Enterprise NVMe SSD, 6800MB/s Read',
                'price' => 28000,
                'image_url' => 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=400',
                'specifications' => [
                    'capacity' => '960GB',
                    'type' => 'NVMe SSD',
                    'interface' => 'PCIe 4.0 x4',
                    'read_speed' => '6800 MB/s',
                    'write_speed' => '4000 MB/s',
                ],
                'sort_order' => 1,
            ],
            [
                'name' => 'Intel D7-P5510 3.84TB NVMe SSD',
                'description' => 'High-capacity enterprise NVMe',
                'price' => 95000,
                'image_url' => 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=400',
                'specifications' => [
                    'capacity' => '3.84TB',
                    'type' => 'NVMe SSD',
                    'interface' => 'PCIe 4.0 x4',
                    'read_speed' => '7000 MB/s',
                    'write_speed' => '4200 MB/s',
                ],
                'sort_order' => 2,
            ],
            [
                'name' => 'Seagate Exos X18 18TB HDD',
                'description' => 'Enterprise HDD for bulk storage',
                'price' => 42000,
                'image_url' => 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=400',
                'specifications' => [
                    'capacity' => '18TB',
                    'type' => 'HDD',
                    'interface' => 'SATA 6Gb/s',
                    'rpm' => '7200',
                    'cache' => '256MB',
                ],
                'sort_order' => 3,
            ],
        ];

        foreach ($storageOptions as $storage) {
            ServerComponent::create(array_merge(['category_id' => $categoryId], $storage));
        }
    }

    private function seedPowerSupplies($categoryId)
    {
        $psus = [
            [
                'name' => 'Supermicro PWS-920P-SQ 920W',
                'description' => 'Redundant 80+ Platinum PSU',
                'price' => 32000,
                'image_url' => 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=400',
                'specifications' => [
                    'wattage' => '920W',
                    'efficiency' => '80+ Platinum',
                    'redundancy' => 'Yes',
                ],
                'sort_order' => 1,
            ],
            [
                'name' => 'Delta DPS-1600AB 1600W',
                'description' => 'High-power redundant 80+ Titanium',
                'price' => 58000,
                'image_url' => 'https://images.unsplash.com/photo-1609091839311-d5365f9ff1c5?w=400',
                'specifications' => [
                    'wattage' => '1600W',
                    'efficiency' => '80+ Titanium',
                    'redundancy' => 'Yes',
                ],
                'sort_order' => 2,
            ],
        ];

        foreach ($psus as $psu) {
            ServerComponent::create(array_merge(['category_id' => $categoryId], $psu));
        }
    }

    private function seedChassis($categoryId)
    {
        $chassisOptions = [
            [
                'name' => 'Supermicro 2U CSE-826',
                'description' => '2U Rackmount, 12x 3.5" Hot-swap bays',
                'price' => 75000,
                'image_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=400',
                'specifications' => [
                    'form_factor' => '2U Rackmount',
                    'drive_bays' => '12x 3.5"',
                    'hot_swap' => 'Yes',
                ],
                'sort_order' => 1,
            ],
            [
                'name' => 'Supermicro 1U CSE-116',
                'description' => '1U Rackmount, 10x 2.5" Hot-swap bays',
                'price' => 68000,
                'image_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=400',
                'specifications' => [
                    'form_factor' => '1U Rackmount',
                    'drive_bays' => '10x 2.5"',
                    'hot_swap' => 'Yes',
                ],
                'sort_order' => 2,
            ],
            [
                'name' => 'Supermicro 4U CSE-847',
                'description' => '4U Rackmount, 36x 3.5" Hot-swap bays',
                'price' => 125000,
                'image_url' => 'https://images.unsplash.com/photo-1558494949-ef010cbdcc31?w=400',
                'specifications' => [
                    'form_factor' => '4U Rackmount',
                    'drive_bays' => '36x 3.5"',
                    'hot_swap' => 'Yes',
                ],
                'sort_order' => 3,
            ],
        ];

        foreach ($chassisOptions as $chassis) {
            ServerComponent::create(array_merge(['category_id' => $categoryId], $chassis));
        }
    }

    private function seedNetworkCards($categoryId)
    {
        $networkCards = [
            [
                'name' => 'Intel X710-DA2 10GbE',
                'description' => 'Dual-port 10 Gigabit Ethernet',
                'price' => 45000,
                'image_url' => 'https://images.unsplash.com/photo-1629654297299-c8506221ca97?w=400',
                'specifications' => [
                    'ports' => '2x SFP+',
                    'speed' => '10GbE',
                    'interface' => 'PCIe 3.0 x8',
                ],
                'sort_order' => 1,
            ],
            [
                'name' => 'Mellanox ConnectX-5 25GbE',
                'description' => 'Dual-port 25 Gigabit Ethernet',
                'price' => 85000,
                'image_url' => 'https://images.unsplash.com/photo-1629654297299-c8506221ca97?w=400',
                'specifications' => [
                    'ports' => '2x SFP28',
                    'speed' => '25GbE',
                    'interface' => 'PCIe 3.0 x8',
                ],
                'sort_order' => 2,
            ],
        ];

        foreach ($networkCards as $card) {
            ServerComponent::create(array_merge(['category_id' => $categoryId], $card));
        }
    }

    private function seedRaidControllers($categoryId)
    {
        $raidControllers = [
            [
                'name' => 'Broadcom MegaRAID 9560-8i',
                'description' => '8-port 12Gb/s SAS RAID, 4GB Cache',
                'price' => 65000,
                'image_url' => 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=400',
                'specifications' => [
                    'ports' => '8 internal',
                    'interface' => 'PCIe 4.0 x8',
                    'cache' => '4GB',
                    'raid_levels' => '0, 1, 5, 6, 10, 50, 60',
                ],
                'sort_order' => 1,
            ],
            [
                'name' => 'Adaptec SmartRAID 3154-16i',
                'description' => '16-port 12Gb/s SAS RAID, 4GB Cache',
                'price' => 95000,
                'image_url' => 'https://images.unsplash.com/photo-1597872200969-2b65d56bd16b?w=400',
                'specifications' => [
                    'ports' => '16 internal',
                    'interface' => 'PCIe 4.0 x8',
                    'cache' => '4GB',
                    'raid_levels' => '0, 1, 5, 6, 10, 50, 60',
                ],
                'sort_order' => 2,
            ],
        ];

        foreach ($raidControllers as $controller) {
            ServerComponent::create(array_merge(['category_id' => $categoryId], $controller));
        }
    }
}
