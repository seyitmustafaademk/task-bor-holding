<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ModelCreateException;
use App\Exceptions\ModelDeleteException;
use App\Exceptions\ModelNotFoundException;
use App\Exceptions\ModelUpdateException;
use App\Http\Controllers\Controller;
use App\Models\Assignment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Exception;

class AssignmentController extends Controller
{
    public function index(): JsonResponse
    {
        try {
            $assignments = Assignment::with(['employee', 'vehicle'])->get();

            return response()->json([
                'status' => 'success',
                'message' => 'Assignments fetched successfully',
                'data' => [
                    'assignments' => $assignments
                ]
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function store(Request $request): JsonResponse
    {
        try {
            $assignment = new Assignment();
            $assignment->employee_id = $request->employee_id;
            $assignment->vehicle_id = $request->vehicle_id;
            $assignment->start_date = $request->start_date;
            $assignment->end_date = $request->end_date;
            $inserted = $assignment->save();

            if (!$inserted) {
                throw new ModelCreateException('Assignment not created');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Assignment created successfully',
                'data' => [
                    'assignment' => $assignment
                ]
            ], 201);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $assignment = Assignment::with(['employee', 'vehicle'])->find($id);

            if (!$assignment) {
                throw new ModelNotFoundException('Assignment not found');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Assignment fetched successfully',
                'data' => [
                    'assignment' => $assignment
                ]
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, string $id): JsonResponse
    {
        try {
            $assignment = Assignment::find($id);

            if (!$assignment) {
                throw new ModelNotFoundException('Assignment not found');
            }

            $assignment->employee_id = $request->employee_id;
            $assignment->vehicle_id = $request->vehicle_id;
            $assignment->start_date = $request->start_date;
            $assignment->end_date = $request->end_date;
            $updated = $assignment->save();

            if (!$updated) {
                throw new ModelUpdateException('Assignment not updated');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Assignment updated successfully',
                'data' => [
                    'assignment' => $assignment
                ]
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function destroy(string $id): JsonResponse
    {
        try {
            $assignment = Assignment::find($id);

            if (!$assignment) {
                throw new ModelNotFoundException('Assignment not found');
            }

            $deleted = $assignment->delete();

            if (!$deleted) {
                throw new ModelDeleteException('Assignment not deleted');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Assignment deleted successfully',
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}
