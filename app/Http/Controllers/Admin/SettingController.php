<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Requests\SettingRequest;
use App\Traits\Uploadable;

class SettingController extends Controller
{
    use Uploadable;

    protected $image_path = 'upload_files/settings';

    /**
     * Display a listing of the resource.
     */
    public function index()
    { 
        return inertia('Admin/Setting/Index')->with([
            'setting' => Setting::first() ?? []
        ]);
    }

    public function store(SettingRequest $request)
    {
        try {
            $setting = Setting::first();
            $input = $request->all();

            if($setting) {
                if($request->hasFile('logo')){
                    $this->deleteFile($setting->logo, $this->image_path);
                    $file = $request->file('logo')->getClientOriginalName();
                    $filename = pathinfo($file, PATHINFO_FILENAME);
                    $filename = $this->uploadFile($request->file('logo'), $filename, $this->image_path);
                    $input['logo'] = $filename;
                } else {
                    $input['logo'] = $setting->logo;
                }

                $setting->update($input);
            } else {
                if($request->hasFile('logo')){
                    $file = $request->file('logo')->getClientOriginalName();
                    $filename = pathinfo($file, PATHINFO_FILENAME);
    
                    $filename = $this->uploadFile($request->file('logo'), $filename, $this->image_path);
                    $input['logo'] = $filename;
                }

                Setting::create($input);
            }

            return redirect()->route('admin.settings.index');

        } catch(\Exception $e) {
            #get message
            session()->flash('failed', $e->getMessage() . ' in file :'.$e->getFile() .' line: '. $e->getLine());

            #redirect
            return redirect()->back()->withInput($request->all());
        }

        
    }
}

