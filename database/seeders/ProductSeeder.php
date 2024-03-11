<?php

namespace Database\Seeders;

use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['product_code' => 'PMC/PRD/000002/2024',
             'name' => 'Multimedia USB Keyboard',
             'catagories_id' => '1',
             'unit_id' => '11',
             'brand' => 'Dell',
             'model_no' => 'KB216d1',
             'description' => "Compact, yet featuring a full-sized keyboard and number pad, the Dell Multimedia Keyboard is ideal for home and office environments. With a durable build and quiet keys, it's designed to provide comfort for the everyday demands of desktop usage.",
             'is_available' => '1',
             'inserted_by' => '1',
             'inserted_at' => Carbon::now()
            ],

            ['product_code' => 'PMC/PRD/000003/2024',
             'name' => 'HP USB Wireless Spill Resistance Keyboard',
             'catagories_id' => '1',
             'unit_id' => '11',
             'brand' => 'HP',
             'model_no' => '4SC12PA',
             'description' => "Stylish Ultra-Slim design Keyboard & Mouse, Sealed membrane for overall protection, Brush metal finish, Advanced controls Smooth responsive cursor control with easy scrolling, Designed for professional or gaming use.",
             'is_available' => '1',
             'inserted_by' => '1',
             'inserted_at' => Carbon::now()
            ],

            ['product_code' => 'PMC/PRD/000004/2024',
             'name' => '24 inch (60 cm) 1920 x 1080 Pixels Monitor',
             'catagories_id' => '2',
             'unit_id' => '7',
             'brand' => 'BenQ',
             'model_no' => 'GW2480',
             'description' => "Anti-Glare, Brightness Intelligence, Low Blue Light, HDMI, DP, Speakers, VESA Wall Mountable (Black).",
             'is_available' => '1',
             'inserted_by' => '1',
             'inserted_at' => Carbon::now()
            ],

            ['product_code' => 'PMC/PRD/000005/2024',
             'name' => 'Passport Portable Hard Disk Drive',
             'catagories_id' => '3',
             'unit_id' => '10',
             'brand' => 'Western Digital',
             'model_no' => 'WDBYVG002',
             'description' => "Western Digital WD 2TB My Passport Portable Hard Disk Drive, USB 3.0 with  Automatic Backup, 256 Bit AES Hardware Encryption,Password Protection,Compatible with Windows and Mac, External HDD-Red.",
             'is_available' => '1',
             'inserted_by' => '1',
             'inserted_at' => Carbon::now()
            ],

            ['product_code' => 'PMC/PRD/000006/2024',
             'name' => 'HP Smart Tank 529 AIO Colour Printer',
             'catagories_id' => '18',
             'unit_id' => '7',
             'brand' => 'HP',
             'model_no' => 'B0BN287KYS',
             'description' => "HP Smart Tank 529 AIO Colour Printer (Upto 6000 Black & 6000 Colour Pages Included in The Box)- Print, Scan & Copy for Office/Home.",
             'is_available' => '1',
             'inserted_by' => '1',
             'inserted_at' => Carbon::now()
            ],

            ['product_code' => 'PMC/PRD/000007/2024',
             'name' => 'FEDUS Cat7 Ethernet Cable',
             'catagories_id' => '8',
             'unit_id' => '5',
             'brand' => 'FEDUS',
             'model_no' => 'B07ZTFSC2X',
             'description' => "FEDUS Cat7 Ethernet Cable,1 Meter 3.2 Feet Pure Bare Copper Double Shielded Outdoor & Indoor Lan Wire Heavy Duty High Speed Solid 24 AWG Network Cable 10Gbps, 600Mhz, Weatherproof S/FTP UV Resistant.",
             'is_available' => '1',
             'inserted_by' => '1',
             'inserted_at' => Carbon::now()
            ],

            ['product_code' => 'PMC/PRD/000008/2024',
             'name' => 'Logitech M235 Wireless Mouse',
             'catagories_id' => '16',
             'unit_id' => '11',
             'brand' => 'Logitech',
             'model_no' => '910-002201',
             'description' => "Logitech M235 Wireless Mouse, 1000 DPI Optical Tracking, 12 Month Life Battery, Compatible with Windows, Mac, Chromebook/PC/Laptop.",
             'is_available' => '1',
             'inserted_by' => '1',
             'inserted_at' => Carbon::now()
            ],
        ];
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
