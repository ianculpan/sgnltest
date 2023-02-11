<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
 /**
  * Seed the application's database.
  *
  * @return void
  */
 public function run()
 {
  // \App\Models\User::factory(10)->create();

  // \App\Models\User::factory()->create([
  //     'name' => 'Test User',
  //     'email' => 'test@example.com',
  // ]);

  //Departments
  $departments = ['director', 'development', 'accounting', 'HR', 'sales'];
  foreach ($departments as $department) {
   \App\Models\Departments::factory()->create([
    'department_name' => $department,
   ]);
  }

  //Locations
  $locations = ['UK', 'USA', 'Italy'];
  foreach ($locations as $location) {
   \App\Models\Locations::factory()->create([
    'location_name' => $location,
   ]);
  }

//Buildings
  $buildings = [
   'Isaac Newton'      => 'UK',
   'Oscar Wilde'       => 'UK',
   'Charles Darwin'    => 'UK',
   'Benjamin Franklin' => 'USA',
   'Luciano Pavarotti' => 'Italy',
  ];
  foreach ($buildings as $building => $location) {
   $locationId = \App\Models\Locations::where('location_name', $location)->first()->id;
   \App\Models\Buildings::create([
    'building_name' => $building,
    'location_id'   => $locationId,
   ]);
  }
  //Employees
  $employees    = ['Julius Ceasar'];
  $employeeRfid = '142594708f3a5a3ac2980914a0fc954f';
  foreach ($employees as $employee) {
   $employee = explode(' ', $employee);
   \App\Models\Employee::factory()->create([
    'first_name' => $employee[0],
    'last_name'  => $employee[1],
    'rfid'       => $employeeRfid,
   ]);
  }

  $buildingDepartments = [
   'Isaac Newton'      => ['development', 'accounting'],
   'Oscar Wilde'       => ['HR', 'sales'],
   'Charles Darwin'    => ['director'],
   'Benjamin Franklin' => ['development', 'sales'],
   'Luciano Pavarotti' => ['development', 'sales'],
  ];

  foreach ($buildingDepartments as $building => $departments) {
   $buildingId = \App\Models\Buildings::where('building_name', $building)->first()->id;
   foreach ($departments as $department) {
    $departmentId = \App\Models\Departments::where('department_name', $department)->first()->id;
    \App\Models\BuildingDepartments::create(['building_id' => $buildingId, 'department_id' => $departmentId]);
   }
  }

  //Need to create access record....
  //rfid , employeeId, buildingId

  $employeeId = \App\Models\Employee::where(['first_name' => 'Julius', 'last_name' => 'Ceasar'])->first()->id;
  //Need to create an access record with the rfid for the employee and directors and development
  $developmentId = \App\Models\Departments::where('department_name', 'development')->first()->id;
  $directorId    = \App\Models\Departments::where('department_name', 'director')->first()->id;
  \App\Models\Access::create([
   'employee_id' => $employeeId,
   'rfid'        => $employeeRfid,
   'location_id' => $directorId,
  ]);
  \App\Models\Access::create([
   'employee_id' => $employeeId,
   'rfid'        => $employeeRfid,
   'location_id' => $developmentId,
  ]);
 }
}
/*

UK buildings:
○ The Isaac Newton building: development and accounting departments
○ The Oscar Wilde building: HR and sales departments
○ The Charles Darwin building: the company headquarters
● USAbuildings:
○ The Benjamin Franklin building: development and sales departments
● ITALYbuildings:
○ The Luciano Pavarotti building: development and sales departments
● ForanemployeeweneedtostoreatleasttheFullname

 */
