<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ModelCreateException;
use App\Exceptions\ModelDeleteException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelUpdateException;
use App\Http\Controllers\Controller;
use App\Models\Employee;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployeeController extends Controller
{

    public function page(): View
    {
        return view('admin.employees');
    }

    public function index(): JsonResponse
    {
        try {
            $employees = Employee::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Employees fetched successfully',
                'data' => [
                    'employees' => $employees
                ]
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $employee = new Employee();
            $employee->firstname = $request->firstname;
            $employee->lastname = $request->lastname;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->position = $request->position;
            $inserted = $employee->save();

            if (!$inserted) {
                throw new ModelCreateException('Employee not created');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Employee created successfully',
                'data' => [
                    'employee' => $employee
                ]
            ], 201);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function show(string $id)
    {
        try {
            $employee = Employee::find($id);
            if (!$employee) {
                throw new ModelNotFoundException('Employee not found');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Employee fetched successfully',
                'data' => [
                    'employee' => $employee
                ]
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id)
    {
        try {
            $employee = Employee::find($id);
            if (!$employee) {
                throw new ModelNotFoundException('Employee not found');
            }

            $employee->firstname = $request->firstname;
            $employee->lastname = $request->lastname;
            $employee->email = $request->email;
            $employee->phone = $request->phone;
            $employee->position = $request->position;
            $updated = $employee->save();

            if (!$updated) {
                throw new ModelUpdateException('Employee not updated');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Employee updated successfully',
                'data' => [
                    'employee' => $employee
                ]
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id)
    {
        try {
            $employee = Employee::find($id);
            if (!$employee) {
                throw new ModelNotFoundException('Employee not found');
            }

            $deleted = $employee->delete();

            if (!$deleted) {
                throw new ModelDeleteException('Employee not deleted');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Employee deleted successfully',
                'data' => [
                    'employee' => $employee
                ]
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}
