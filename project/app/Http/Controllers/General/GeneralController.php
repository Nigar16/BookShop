<?php

namespace App\Http\Controllers\General;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function index(){
        return view('index');
    }

    public static function getRole($id = null){
        $role = $id == null ? Auth::user()->roles : User::find($id)->roles;

        switch ($role){
            case "1":
                return "Super Admin";
            case "2":
                return "Moderator";
        }

    }

    public static function  getRoles(){
        return [1,2];
    }

    public static function getRoleWithKey($key){
        switch ($key){
            case "1":
                return "Super Admin";
            case "2":
                return "Moderator";
        }
    }
    //GeneralController
    public static function emailRepeat($currentEmail, $newEmail) {
        if ($currentEmail != $newEmail) {
            $data = User::where("email", $newEmail)->first();

            if ($data) {
                return true;
            }
            return false;
        }
        else {
            return false;
        }
    }
    public static function phoneRepeat($currentPhone, $newPhone) {
        if ($currentPhone != $newPhone) {
            $data = Customers::where("phone", $newPhone)->first();

            if ($data) {
                return true;
            }
            return false;
        }
        else {
            return false;
        }
    }
}
