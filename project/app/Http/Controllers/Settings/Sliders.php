<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sliders as SliderModel;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;

class Sliders extends Controller
{
    public function sliderIndex()
    {
        $all_data = SliderModel::all();
        View::share("data", $all_data);

        return view('settings.sliders ');
    }

    public function sliderPost(Request $request)
    {
        $request->validate([
            'add_name' => 'required|min:5|max:255',
            'add_url' => 'required|url|max:255',
            'image' => 'required|image|mimes:png,jpeg,gif|max:1024'
        ]);

        $directory = 'assets/media/sliders/';
        $image = $request->file('image');
        $image_name = Str::slug($request->add_name) . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();

        $image->move($directory, $image_name);
        $image_name = $directory . $image_name;

        $data = SliderModel::create([
            "name" => $request->add_name,
            "url" => $request->add_url,
            "img" => $image_name,
        ]);

        return redirect()->back()->with($data ? "success" : "error", true);
    }

    public function sliderDelete($id)
    {
        $check = SliderModel::find($id);
        if ($check) {
            if (file_exists($check->img)) {
                unlink($check->img);
            }
            return redirect()->back()->with($check->delete() ? "success" : "error", true);
        }
        return redirect()->back()->with("error", true);
    }

    public function getSlider(Request $request)
    {
        $slider = SliderModel::find($request->id);
        if ($slider) {
            return $slider;
        }
        return 0;
    }

    public function sliderEdit(Request $request){
        $request->validate([
            'edit_name' => 'required|max:200',
            'edit_url' => 'required|url|max:255',
            'edit_image' => 'image|mimes:png,jpeg,gif|max:1024'
        ]);
        $slider = SliderModel::find($request->edit_id);
        if ($slider) {
            if ($slider->name != $request->edit_name) {
                $request->validate([
                    'edit_image' => 'required'
                ]);
            }
            if ($request->file('edit_image')) {
                $image = $request->file('edit_image');
                $name = Str::slug($request->edit_name) . '-' . rand(1000, 9999) . '.' . $image->getClientOriginalExtension();
                $directory = 'assets/media/sliders/';
                if (file_exists($slider->img)) {
                    unlink($slider->img);
                }
                $image->move($directory, $name);
                $name = $directory . $name;
                $slider->img = $name;
            }
            $slider->name = $request->edit_name;
            $slider->url = $request->edit_url;
            $slider->status = $request->edit_status;

            return redirect()->back()->with($slider->save() ? "success" : 'error', true);
        }
        else return redirect()->back()->with('error', true);
    }
}
