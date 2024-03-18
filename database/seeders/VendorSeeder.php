<?php

namespace Database\Seeders;

use App\Models\Vendor;
use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class VendorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $vendor = [
            [
                'company_name' => 'Reliance Industries',
                'company_add' => 'Mumbai',
                'company_phone_no' => '0214563987',
                'person_name' =>  'Mr. Ajay Kumar Sharma',
                'phone' => '1236547455',
                'email' => 'reliance@gmail.com',
                'gst_no' => '123658741023',
                'description' => 'Reliance Industries Limited (RIL) is a big Indian
                                  company based in Mumbai. It started in 1966 and did
                                  many different things in various industries.',
                'inserted_by' => 1,
                'inserted_at' => Carbon::now()
            ],

            [
                'company_name' => 'TCS ( Tata Consultancy Services )',
                'company_add' => 'Navi Mumbai,  Maharashtra, India.',
                'company_phone_no' => '5543534534',
                'person_name' =>  'Dr. Ritesh Kumar Gupta',
                'phone' => '6786732427',
                'email' => 'qojy@mailinator.com',
                'gst_no' => '123658741023',
                'description' => "TCS, a global leader in IT services, consulting, and business solutions, leverages technology for business transformation and helps catalyze change.",
                'inserted_by' => 1,
                'inserted_at' => Carbon::now()
            ],

            [
                'company_name' => 'Infosys',
                'company_add' => 'Navi Mumbai,  Maharashtra, India.',
                'company_phone_no' => '1314456464',
                'person_name' => 'Er. Sunil Kumar Jha',
                'phone' => '0212116549',
                'email' => 'qiput@mailinator.com',
                'gst_no' => '54465464654',
                'description' => 'Infosys is known for its skilled workforce and focus on innovation. It has a global presence and works with clients from various industries.',
                'inserted_by' => 1,
                'inserted_at' => Carbon::now()
            ],

            [
                'company_name' => 'Hindustan Unilever Ltd',
                'company_add' => '405-b, Vertex Vikas, M Vasanji Road, Opp Railway Station, Andheri (west).',
                'company_phone_no' => '4445646545',
                'person_name' => 'Mrs. Neena Bajpai',
                'phone' => '1231545465',
                'email' => 'lyge@mailinator.com',
                'gst_no' => '0123654789',
                'description' => 'Hindustan Unilever Limited (HUL) is a big consumer goods company in India. It is a subsidiary of the British company Unilever.',
                'inserted_by' => 1,
                'inserted_at' => Carbon::now()
            ],

            [
                'company_name' => 'Bharti Airtel',
                'company_add' => '9th Floor, B Wing, Trade World , Kamala Mills Compound, Senapati Bapat Marg, Lower Parel (west)',
                'company_phone_no' => '3456466565',
                'person_name' => 'Mr. Anand Sharma',
                'phone' => '1121231321',
                'email' => 'jirizanale@gmail.com',
                'gst_no' => '12312315456465',
                'description' => "Bharti Airtel Ltd. (airtel) is a multinational telecommunication company based in New Delhi.",
                'inserted_by' => 1,
                'inserted_at' => Carbon::now()
            ],

            [
                'company_name' => 'State Bank of India',
                'company_add' => 'B-2, Shivai Apartment, Pokhran Road, Shivai Nagar,khopat, Thane.',
                'company_phone_no' => '1231231231',
                'person_name' => 'Dr. Rakesh Kumar',
                'phone' => '2354564564',
                'email' => 'finixid@gmail.com',
                'gst_no' => '12312315456465',
                'description' => "The State Bank of India (SBI) is a veteran multinational public sector bank and financial service provider in India.",
                'inserted_by' => 1,
                'inserted_at' => Carbon::now()
            ],
        ];

        foreach ($vendor as $data) {
            Vendor::create($data);
        }
    }
}
