<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\GeneralController;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;
use App\Mail\SendMail;
use Illuminate\Support\Facades\Mail;
class General extends Controller
{
    public function usersGet()
    {
        $data = User::where("roles",  "2")->get();
        View::share("users", $data);
        View::share("roles", GeneralController::getRoles());
        return view('users.list');
    }

    public function getUser(Request $request)
    {
        $user = User::find($request->id);
        if ($user) {
            return $user;
        }
        return 0;
    }

    public function userEdit(Request $request)
    {
        $request->validate([
            'edit_name' => 'required|max:200',
            'edit_email' => 'required|email',
            'edit_position' => 'required',
        ]);

        $user = User::find($request->edit_id);
        if ($user) {
            if (GeneralController::emailRepeat($user->email, strtolower($request->edit_email))) {
                return redirect()->back()->with('error_mail', true);
            }
            $user->name = $request->edit_name;
            $user->email = $request->edit_email;
            $user->position = $request->edit_position;
            $user->roles = $request->edit_roles;
            $user->status = $request->edit_status;

            if (strlen($request->edit_password) > 7) {
                $user->password = Hash::make($request->edit_password);
                $mail = array(
                    'title' => "Book Shop Admin Panel - Şifrə Yeniləndi",
                    "name" => $request->edit_name,
                    "email" => strtolower($request->edit_email),
                    "password" => $request->edit_password,
                    'view' => 'mails.new_password'
                );
                Mail::to(strtolower($request->edit_email))->send(new SendMail($mail));

            }
            return redirect()->back()->with($user->save() ? "success" : 'error', true);
        } else {
            return redirect()->back()->with('error', true);
        }

    }

    public function userAdd(Request $request){
        $request->validate([
            'add_name' => 'required|max:200',
            'add_email' => 'required|email|unique:users,email',
            'add_position' => 'required',
            'add_password' => 'required|min:8'
        ]);

        $password = Hash::make($request->add_password);


        $data = User::create([
            'name' => $request->add_name,
            'email' => strtolower($request->add_email),
            'roles' => $request->add_roles,
            'position' => $request->add_position,
            'status' =>  $request->add_status,
            'password' =>  $password,
        ]);
        $mail = array(
            'title' => "Book Shop Admin Panel - Xoş gəldiniz",
            "name" => $request->add_name,
            "email" => strtolower($request->add_email),
            "password" => $request->add_password,
            'view' => 'mails.new_user'
        );
        Mail::to(strtolower($request->add_email))->send(new SendMail($mail));
        if($data){
            return redirect()->back()->with("add_success", $request->add_name);
        }
        else {
            return redirect()->back()->with("add_error", true);
        }

    }
}
