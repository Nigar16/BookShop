<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class General extends Controller
{
    public function generalIndex(){
        $data = Settings::all();
        View::share("data",$data);
        return view('settings.general');
    }
    public function generalPost(Request $request){
        $request->validate([
            'default_title' => 'required|max:255',
            'default_description' => 'required|max:255',
            'default_keywords' => 'required|max:255',
        ]);

        $data = Settings::find(1);
        $data->default_title = $request->default_title;
        $data->default_description = $request->default_description;
        $data->default_keywords = $request->default_keywords;

        return redirect()->back()->with($data->save() ? "success" : "error",true);

    }

    public function logoChange(Request $request){
        $request->validate([
            'logo_light' => 'required|image|mimes:png|max:1024',
            'logo_dark' => 'required|image|mimes:png|max:1024'
        ]);
        $data = Settings::find(1);
        $directory = 'assets/media/logo/';
        $image_light = $request->file('logo_light');
        $image_dark = $request->file('logo_dark');
        $name_light = 'logo-light.png';
        $name_dark = 'logo-dark.png';


        if (file_exists($data->logo_light)) {
            unlink($data->logo_light);
        }
        if (file_exists($data->logo_dark)) {
            unlink($data->logo_dark);
        }
        $image_light->move($directory, $name_light);
        $image_dark->move($directory, $name_dark);

        $name_light = $directory.$name_light;
        $name_dark = $directory.$name_dark;

        $data->logo_light = $name_light;
        $data->logo_dark = $name_dark;

        return redirect()->back()->with( $data->save() ? "success" : "error", true);
    }
}
