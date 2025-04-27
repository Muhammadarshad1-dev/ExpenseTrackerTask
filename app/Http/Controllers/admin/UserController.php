<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\Designation;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserController extends Controller
{
    public function index()
    {
        $desginations = Designation::latest()->get();
        $allUsers = User::with('designation')
                ->latest()
                ->get();

        $data = array(
            'desginations' => $desginations,
            'allUsers' => $allUsers
        );
        return view('admin.users.index',$data);
    }


    public function store(request $request)
    {
        $desgination = Designation::find($request->designation);

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'phone' => 'required|numeric',
            'designation' => 'required',
            'password' => 'required',
            'status' => 'required',
        ];

         $validator = Validator::make($request->all(), $rules);
         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()]);
         }

        $user = new User();
        $user->designation_id = $request->designation;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->role = $desgination->name;
        $user->password = Hash::make($request->password);
        $user->status = $request->status;
        if ($user->save()) {
            return response()->json([
                'status' => true,
                'message' => 'User created successfully',
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error!! Something is wrong, try again',
            ], 500);
        }
    }


    public function destory(request $request)
    {
        $delete = User::find($request->id);
        $delete->delete();
        $request->session()->flash('success','User deleted successfully');
        return response()->json([
            'status' => true,
            'redirect' => route('users.index')
        ]);
    }

    public function edit($id)
    {
        try {
            $decryptedId = Crypt::decrypt($id);
        } catch (DecryptException $e) {
            // Handle decryption failure
            return redirect()->route('users.index')->with('error', 'Invalid user ID');
        }

        $allUsers = User::with('designation')->latest()->get();
        $edits = User::with('designation')->find($decryptedId);

        if (!$edits) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        $desginations = Designation::latest()->get();

        $data = [
            'desginations' => $desginations,
            'allUsers' => $allUsers,
            'edits' => $edits
        ];

        return view('admin.users.edit', $data);
    }


    public function update(request $request)
    {
        $updateUser = User::find($request->ueid);
        $desgination = Designation::find($request->designation);

        $rules = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $updateUser->id,
            'phone' => 'required|numeric',
            'designation' => 'required',
            'status' => 'required',
        ];

         $validator = Validator::make($request->all(), $rules);

         if ($validator->fails()) {
             return response()->json(['errors' => $validator->errors()]);
         }

         $updateUser->designation_id = $request->designation;
         $updateUser->name = $request->name;
         $updateUser->email = $request->email;
         $updateUser->phone = $request->phone;
         $updateUser->role = $desgination->name;

         if ($request->has('password')) {
            $updateUser->password = Hash::make($request->password);
        }
         $updateUser->status = $request->status;

         if ($updateUser->save()) {
            return response()->json([
                'status' => true,
                'message' => 'User updated successfully',
                'redirect' => route('users.index')
            ]);
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Error!! Something is wrong, try again',
            ]);
        }
    }

}
