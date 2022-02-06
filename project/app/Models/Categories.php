<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
    use HasFactory;
    protected $table = "categories";
    protected $guarded = [];

    public function mainCategoryData($id) {
        return Categories::find($id);
    }

    public function SubCategoryGet($main){
        $data = Categories::where("main_category",$main)->get();
        if(count($data) > 0){
            return $data;
        }
        return null;
    }
}
