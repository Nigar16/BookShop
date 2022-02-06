<?php

namespace App\Http\Controllers\Customers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\General\GeneralController;
use App\Models\Customers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Str;


class General extends Controller
{
    public function CustomersList()
    {
        $all_data = Customers::all();
        View::share("customers", $all_data);
        return view('customers.list');
    }

    public static function UserGet($id)
    {
        $data = User::find($id);
        return $data ?? null;
    }

    public function CustomersView(Request $request)
    {
        $data = Customers::find($request->id);
        if ($data) {
            $user = User::find($data->user_id);
            if ($user) {
                return response()->json([
                    'customer' => $data,
                    'user' => $user,
                    'status' => true,
                ]);
            } else {
                return response()->json([
                    'status' => false,
                ]);
            }

        } else {
            return response()->json([
                'status' => false,
            ]);
        }
    }

    public function CustomersEdit(Request $request) {
        $request->validate([
            'edit_image_customer' => 'image|mimes:jpg,jpeg,png|max:1024',
            'edit_name_customer' => 'required|max:255',
            'edit_email_customer' => 'required|email|max:255',
            'edit_phone_customer' => 'required|max:50',
            'edit_address_customer' => 'required',
            'edit_birthday_customer' => 'required|date'
        ]);

        $customer = Customers::find($request->edit_id_customer);
        if ($customer) {
            $user = User::find($customer->user_id);
            if ($user) {
                if (GeneralController::emailRepeat($user->email, strtolower($request->edit_email_customer))) {
                    return redirect()->back()->with('error_mail', true);
                }

                if (GeneralController::phoneRepeat($customer->phone, $request->edit_phone_customer)) {
                    return redirect()->back()->with('error_phone', true);
                }

                if ($request->hasFile('edit_image_customer')) {
                    $image = $request->file('edit_image_customer');
                    $name = Str::slug($request->edit_name_customer) . '-' . rand(1000,9999) . '.' . $image->getClientOriginalExtension();
                    $directory = 'assets/media/users/';
                    if (file_exists($user->img) && $user->img != "assets/media/avatars/avatar0.jpg") {
                        unlink($user->img);
                    }

                    $image->move($directory, $name);
                    $name = $directory.$name;
                    $user->img = $name;
                }

                $user->name = $request->edit_name_customer;
                $user->email = strtolower($request->edit_email_customer);
                $customer->phone = $request->edit_phone_customer;
                $customer->address = $request->edit_address_customer;
                $customer->birthday = $request->edit_birthday_customer;
                $customer->status = $request->edit_status_customer;

                return redirect()->back()->with($user->save() && $customer->save() ? "success" : 'error', true);
            }
            else {
                return redirect()->back()->with('error', true);
            }
        }
        else {
            return redirect()->back()->with('error', true);
        }
    }
}
