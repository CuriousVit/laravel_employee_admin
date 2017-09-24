<?php
//To enable strict mode
declare(strict_types=1);

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\ModelNotFoundException;
//Group use declarations
use App\{Employee, User};

class EmployeeController extends Controller
{
    //Constant arrays
    const VISIBLE_EMPLOYEE_FIELDS = [
        'name',
        'date_of_birth',
        'address',
    ];

    /**
     * Return all
     *
     * @return Employee
     */
    public function index()
    {
        return Employee::all();
    }

    /**
     * Get employee by id
     *
     * @param $id
     * @return mixed
     */
    public function show($id): Employee
    {
        return Employee::find($id);
    }

    /**
     * Create a new employee
     *
     * @param Request $request
     * @return Employee
     */
    public function store(Request $request): Employee
    {
        return Employee::create($request->all());
    }

    /**
     * Update existing employee
     *
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, int $id): Employee
    {
        $employee = Employee::findOrFail($id);
        $employee->update($request->all());

        return $employee;
    }

    /**
     * Delete endpoint
     *
     * @param Request $request
     * @param $id
     * @return int
     */
    public function delete(Request $request, int $id): int
    {
        $employee = Employee::findOrFail($id);
        $employee->delete();

        return 204;
    }

    /**
     * Method to delete multiple employees with Splat Operator
     *
     * Usage:
     * $this->deleteMultipleEmployees(1, 3, 5);
     *
     * Returns: array of true/false
     *
     * @param int[] ...$ids
     * @return array
     */
    public function deleteMultipleEmployees(int ...$ids): array
    {
        return array_map(function(int $id): bool {
            try {
                $employee = Employee::findOrFail($id);
                $employee->delete();
            } catch(ModelNotFoundException $e) {
                return false;
            }

            return true;
        }, $ids);
    }
}
