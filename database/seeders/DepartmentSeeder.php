<?php

namespace Database\Seeders;

use App\Models\Department;
use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $departments = [
            ['department_name' => 'Road & Infrastructure'],
            ['department_name' => 'Sanitation Department'],
            ['department_name' => 'Water Supply Board'],
            ['department_name' => 'Electricity Department'],
        ];

        foreach($departments as $department){
            Department::create($department);
        }
    }
}
