<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class Contact extends Controller
{
    public function contactIndex(){
        $data = Settings::all();
        View::share("data",$data);
        return view('settings.contact');
    }
    public function contactPost(Request $request){
        $request->validate([
            'phone_number_1' => 'required|max:50',
            'phone_number_2' => 'required|max:50',
            'address' => 'required|max:500',
        ]);

        $data = Settings::find(1);
        $data->phone1= $request->phone_number_1;
        $data->phone2 = $request->phone_number_2;
        $data->address = $request->address;

        return redirect()->back()->with($data->save() ? "success" : "error",true);

    }

}
