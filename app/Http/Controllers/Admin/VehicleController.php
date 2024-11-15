<?php

namespace App\Http\Controllers\Admin;

use App\Exceptions\ModelCreateException;
use App\Exceptions\ModelNotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\StoreRequest;
use App\Http\Requests\Vehicle\UpdateRequest;
use App\Models\Vehicle;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function page()
    {
        return view('admin.vehicles');
    }

    public function index(): JsonResponse
    {
        try {
            $vehicles = Vehicle::all();

            return response()->json([
                'status' => 'success',
                'message' => 'Vehicles fetched successfully',
                'data' => [
                    'vehicles' => $vehicles
                ]
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function store(StoreRequest $request): JsonResponse
    {
        try {
            $vehicle = new Vehicle();
            $vehicle->brand = $request->brand;
            $vehicle->model = $request->model;
            $vehicle->plate = $request->plate;
            $vehicle->color = $request->color;
            $vehicle->year = $request->year;
            $vehicle->km = $request->km;
            $vehicle->is_active = $request->is_active;
            $inserted = $vehicle->save();

            if (!$inserted) {
                throw new ModelCreateException('Vehicle not created');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Vehicle created successfully',
                'data' => [
                    'vehicle' => $vehicle
                ]
            ], 201);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage(),
            ], 500);
        }
    }

    public function show(string $id): JsonResponse
    {
        try {
            $vehicle = Vehicle::find($id);
            if (!$vehicle) {
                throw new ModelNotFoundException('Vehicle not found');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Vehicle fetched successfully',
                'data' => [
                    'vehicle' => $vehicle
                ]
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }

    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        try {
            $vehicle = Vehicle::find($id);
            if (!$vehicle) {
                throw new ModelNotFoundException('Vehicle not found');
            }

            $vehicle->brand = $request->brand;
            $vehicle->model = $request->model;
            $vehicle->plate = $request->plate;
            $vehicle->color = $request->color;
            $vehicle->year = $request->year;
            $vehicle->km = $request->km;
            $vehicle->is_active = $request->is_active;
            $updated = $vehicle->save();

            if (!$updated) {
                throw new ModelCreateException('Vehicle not updated');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Vehicle updated successfully',
                'data' => [
                    'vehicle' => $vehicle
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
            $vehicle = Vehicle::find($id);
            if (!$vehicle) {
                throw new ModelNotFoundException('Vehicle not found');
            }

            $deleted = $vehicle->delete();

            if (!$deleted) {
                throw new ModelCreateException('Vehicle not deleted');
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Vehicle deleted successfully',
            ], 200);
        } catch (Exception $ex) {
            return response()->json([
                'status' => 'error',
                'message' => $ex->getMessage()
            ], 500);
        }
    }
}
