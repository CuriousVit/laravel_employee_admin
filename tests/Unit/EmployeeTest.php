<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Employee;

class EmployeeTest extends TestCase
{
    /**
     * A basic test to check employee model.
     *
     * @return void
     */
    public function testEmployeeModel()
    {
        $employees = Employee::all();
        foreach ($employees as $employee) {
            $this->assertNotNull($employee->name);
            $this->assertNotNull($employee->date_of_birth);
            $this->assertNotNull($employee->address);
            $this->assertNull($employee->random_field);
        }
    }
}
