<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class Social extends Controller
{
    public function socialIndex(){
        $data = Settings::all();
        View::share("data",$data);
        return view('settings.social');
    }
    public function socialPost(Request $request){
        $request->validate([
            'instagram' => 'required|max:50',
            'facebook' => 'required|max:50',
        ]);

        $data = Settings::find(1);
        $data->instagram= $request->instagram;
        $data->facebook = $request->facebook;

        return redirect()->back()->with($data->save() ? "success" : "error",true);

    }

}
