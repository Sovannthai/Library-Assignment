<?php

namespace App\Http\Controllers\Backends;

use Exception;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\BusinessSetting;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class BusinessSettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $business_setting = BusinessSetting::first();
        return view('backends.setting.index', compact('business_setting'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try {
            $business_setting = BusinessSetting::firstOrNew();
            $old_logo_path = $business_setting->business_logo;

            if ($request->hasFile('business_logo')) {
                $business_logo = $request->file('business_logo');
                $extension = $business_logo->getClientOriginalExtension();
                $imageName = Carbon::now()->toDateString() . "-" . uniqid() . "." . $extension;
                $business_logo->move(public_path('uploads/all_photo/'), $imageName);

                if ($old_logo_path && File::exists(public_path('uploads/all_photo/' . $old_logo_path))) {
                    File::delete(public_path('uploads/all_photo/' . $old_logo_path));
                }

                $business_setting->business_logo = $imageName;
            }

            $business_setting->save();

            $output = [
                'success' => 1,
                'msg' => _('Setting Updated Successfully')
            ];
        } catch (Exception $e) {
            dd($e);
            $output = [
                'error' => 0,
                'msg' => _('Something went wrong')
            ];
        }

        return redirect()->route('business_setting.index')->with($output);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
