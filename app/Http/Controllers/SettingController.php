<?php

namespace App\Http\Controllers;

use App\Http\Traits\attachfiletrait;
use App\Models\setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    use attachfiletrait;

    public function index()
    {
        //21:00 video 44
        $collection = setting::all();
        // 23:00 video 44
        $setting['setting'] = $collection->flatMap(function ($collection) {
            return [$collection->key => $collection->value];
        });





        return view('setting.index', $setting);
    }


    // 28:01 video 44
    public function update(Request $request)
    {

        try {

            // 30:35 video 44
            $info = $request->except('_token', '_method', 'logo');
            // 33:00  video 44
            foreach ($info as $key => $value) {
                Setting::where('key', $key)->update(['value' => $value]);
            }

            //            $key = array_keys($info);
            //            $value = array_values($info);
            //            for($i =0; $i<count($info);$i++){
            //                Setting::where('key', $key[$i])->update(['value' => $value[$i]]);
            //            }
            // 41:00 video 44
            if ($request->hasFile('logo')) {
                $logo_name = $request->file('logo')->getClientOriginalName();
                setting::where('key', 'logo')->update(['value' => $logo_name]);
                $this->uploadFile($request,'logo','logo');


           
            }


            return redirect()->back();
        } catch (\Throwable $th) {

            return redirect()->back()->withErrors(['error' => $th->getMessage()]);
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */


    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(setting $setting)
    {
        //
    }
}
