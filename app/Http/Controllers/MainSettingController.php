<?php

namespace App\Http\Controllers;

use App\Models\MainSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function get()
    {
        return MainSetting::all()->first();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $setting = new MainSetting;
        $setting->schedule = $request->input('schedule');
        $setting->phone_number = $request->input('phone_number');
        $setting->about_us = $request->input('about_us');
        $setting->address = $request->input('address');
        $setting->save();
        return $setting;
    }

    /**
     * Display the specified resource.
     */
    public function show(MainSetting $mainSetting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(MainSetting $mainSetting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $validateSettings = Validator::make(
                $request->all(),
                [
                    'schedule' => 'required',
                    'phone_number' => 'required',
                    'about_us' => 'required|min:20',
                    'address' => 'required|min:10',
                ]
            );

            if ($validateSettings->fails()) {
                return response()->json([
                    'status' => false,
                    'message' => 'Помилка валідації даних',
                    'errors' => $validateSettings->errors(),
                ], 422);
            }
            $mainSetting = MainSetting::all()->first();

            if (!$mainSetting) {
                return response()->json("Main settings not found");
            }

            $mainSetting->schedule = $request->input('schedule');
            $mainSetting->phone_number = $request->input('phone_number');
            $mainSetting->about_us = $request->input('about_us');
            $mainSetting->address = $request->input('address');

            $mainSetting->save();

            return response()->json([
                'status' => true,
                'message' => 'Дані успішно змінено!',
            ], 200);
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MainSetting $mainSetting)
    {
        //
    }
}
