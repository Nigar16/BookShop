<?php

namespace App\Http\Controllers\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;
use App\Models\Categories as CategoryModel;

class Categories extends Controller
{
    public function categoriesListIndex() {
        $all_data = CategoryModel::all();
        View::share("all_data", $all_data);
        $main_categories = CategoryModel::where("main_category", 0)->get();
        View::share("main_categories", $main_categories);
        return view('products.categories');
    }

    public function categoriesAddIndex() {
        $main_categories = CategoryModel::where("main_category", 0)->get();
        View::share("main_categories", $main_categories);

        return view('products.category-add');
    }

    public function categoriesAddPost(Request $request) {
        $request->validate([
           'name' => 'required|max:150|min:5',
        ]);

        $data = CategoryModel::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'main_category' => $request->main_category != "" || $request->main_category != null ? $request->main_category : 0,
        ]);

        return redirect()->back()->with($data ? "success" : "error" , true);
    }

    public function categoriesView(Request $request) {
        $category = CategoryModel::find($request->id);

        if ($category) {
            return $category;
        }
        return 0;
    }

    public function categoriesEdit(Request $request){
        $request->validate([
            'edit_name' => 'required|max:255'
        ]);
        $category = CategoryModel::find($request->edit_id);

        if($category){

            if($category->main_category=="0"){
                if($request->edit_status=="0"){
                    $childs=CategoryModel::where("main_category",$request->edit_id)->get();
                    if ($childs) {
                        foreach ($childs as $child) {
                            $child->status = $request->edit_status;
                            $child->save();
                        }
                    }
                }
                $category->status=$request->edit_status;
            }
            else if ($category->main_category == "-1" && $request->edit_status == "1") {
                return redirect()->back()->with("error_category", true);
            }
            else{
                $parent=CategoryModel::find($request->edit_main_category);
                if($request->edit_status=="1"){
                    if($parent->status=="0"){
                     }
                    else{
                        $category->status=$request->edit_status;
                    }
                }else{
                    $category->status=$request->edit_status;
                }
            }
            $category->name=$request->edit_name;
            $category->slug=Str::slug($request->edit_name);
            $category->main_category = $request->edit_main_category;
            return redirect()->back()->with($category->save() ? "success" : 'error', true);
        }else {
            return redirect()->back()->with('error', true);
        }
    }

    public function delete($id){
        $check = CategoryModel::find($id);
        if($check){
            $check_main = CategoryModel::where(["id"=>$id,"main_category"=>"0"])->first();
            if($check_main) {
                $sub_categories = CategoryModel::where("main_category", $id)->get();
                foreach ($sub_categories as $sub) {
                    $sub->status = "0";
                    $sub->main_category = -1;
                    $sub->save();
                }
                $check_main->delete();
            }
            $check->delete();

        }

        return redirect()->back();
    }

}
