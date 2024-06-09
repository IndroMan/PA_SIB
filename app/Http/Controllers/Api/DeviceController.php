<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Device;

class DeviceController extends Controller
{

    public function index()
    {
        return Device::all();
    }

    public function create()
    {
        //
    }

    // [POST] data from device
    public function post_device(Request $request, $userId)
    {
        try {
            $validated = $request->validate([
                'temperature' => ['decimal:1'],
                'humidity' => ['decimal:1'],
                'light_intensity' => ['decimal:1']
            ]);
            $dataSensor = Device::create([
                'user_id' => $userId,
                'temperature' => $request->temperature,
                'humidity' => $request->humidity,
                'light_intensity' => $request->light_intensity,
            ]);
            return response()->json([
                "status" => "Success",
                "message" => "Data successfuly created",
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                "status" => "Error",
                "message" => "Data error",
                "error" => $e->getMessage(),
            ], 400);
        }
    }

    // public function store(Request $request $userId)
    // {
    //     try {
    //         $validated = $request->validate([
    //             'temperature' => ['decimal:1'],
    //             'humidity' => ['decimal:1'],
    //             'light_intensity' => ['decimal:1']
    //         ]);
    //         $dataSensor = Device::create([
    //             'device_id' => $deviceId,
    //             'temperature' => $request->temperature,
    //             'humidity' => $request->humidity,
    //             'light_intensity' => $request->light_intensity,
    //         ]);
    //         return response()->json([
    //             "status" => "Success",
    //             "message" => "Data successfuly created",
    //         ], 201);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             "status" => "Error",
    //             "message" => "Data error",
    //             "error" => $e->getMessage(),
    //         ], 400);
    //     }
    //     // $device = new Device;
    //     // $device->user_id = $request->user_id;
    //     // $device->name = $request->name;
    //     // $device->save();
    //     // return response()->json([
    //     //     "message" => "Device telah ditambahkan."
    //     // ], 201);
    // }

    public function show(string $id)
    {
        return Device::find($id);
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        if (Device::where('id', $id)->exists()) {
            $device = Device::find($id);
            $device->user_id = is_null($request->user_id) ? $device->user_id : $request->user_id;
            $device->name = is_null($request->name) ? $device->name : $request->name;
            $device->save();
            return response()->json([
                "message" => "Device telah diupdate."
            ], 201);
        } else {
            return response()->json([
                "message" => "Device tidak ditemukan."
            ], 404);
        }
    }

    public function destroy(string $id)
    {
        if (Device::where('id', $id)->exists()) {
            $users = Device::find($id);
            $users->delete();
            return response()->json([
                "message" => "Device telah dihapus."
            ], 201);
        } else {
            return response()->json([
                "message" => "Device tidak ditemukan."
            ], 404);
        }
    }
}