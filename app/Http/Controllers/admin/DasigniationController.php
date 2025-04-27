<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Designation;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class DasigniationController extends Controller

{
    public function index()
    {
        $designations = Designation::latest()->get();
        return view('admin.dasignation.index', compact('designations'));
    }

    public function store(Request $request)
    {
        $rules = [
            'name' => ($request->deId ? 'required|unique:designations,name,' . $request->deId : 'required|unique:designations,name'),
            'status' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $designation = Designation::find($request->deId);

        if (!$designation) {
            $designation = new Designation;
            $msg = [
                'status' => true,
                'message' => 'Designation Successfully Added',
                'redirect' => route('dasignation.index')
            ];
        } else {
            $msg = [
                'status' => true,
                'message' => 'Designation Successfully Updated',
                'redirect' => route('dasignation.index')
            ];
        }

        $designation->name = $request->name;
        $designation->status = $request->status;
        $designation->save();

        return response()->json($msg);
    }







    public function edit($dId)
    {
        try {
            $cid = Crypt::decrypt($dId);
        } catch (DecryptException $e) {
            // Handle decryption failure
            return redirect()->route('dasignation.index')->with('error', 'Invalid Dasignation ID');
        }

        $edits = Designation::find($cid);

        if (!$edits) {
            return redirect()->route('dasignation.index')->with('error', 'Dasignation not found');
        }

        $designations = Designation::latest()->get();

        $data = array(
            'title' => 'Edit Desigantion',
            'designations' => $designations,
            'edits' => $edits,
            'button' => 'Update'
        );
        return view('admin.dasignation.index', $data);
    }


    public function destory(request $request)
    {
        $product = Designation::find($request->id);
        $product->delete();
        $request->session()->flash('success','Designation deleted successfully');
        return response()->json([
            'status' => false,
            'message' => 'Designation delete successfully',
        ]);
    }
}
