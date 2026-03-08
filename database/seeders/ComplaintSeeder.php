<?php

namespace Database\Seeders;

use App\Models\Complaint;
use Illuminate\Database\Seeder;

class ComplaintSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $complaints = [
            [
                'user_id' => 2,
                'category_id' => 1,
                'title' => 'Large pothole on MG Road',
                'description' => 'There is a large pothole causing accidents near MG Road signal.',
                'status' => 'pending',
            ],

            [
                'user_id' => 2,
                'category_id' => 2,
                'title' => 'Garbage not collected for 3 days',
                'description' => 'Garbage has not been collected in our area for 3 days.',
                'status' => 'in_progress',
                'department_id' => 2,
            ],

            [
                'user_id' => 2,
                'category_id' => 3,
                'title' => 'Water pipe leakage near park',
                'description' => 'A water pipe is leaking near the community park wasting water.',
                'status' => 'resolved',
                'department_id' => 3,
            ],

            [
                'user_id' => 2,
                'category_id' => 4,
                'title' => 'Streetlight not working',
                'description' => 'The streetlight near building 42 has been off for a week.',
                'status' => 'pending',
            ],
        ];

        foreach($complaints as $complaint){
            Complaint::create($complaint);
        }
    }
}
