<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::all();
        $data = array(
            'title' => 'Add Category',
            'category' => $category
        );

        return view('admin.category.create',$data);
    }


    public function store(Request $request)
    {
        $rules = [
            'name' => ($request->deId ? 'required|unique:categories,name,' . $request->deId : 'required|unique:categories,name'),
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $category = Category::find($request->deId);

        if (!$category) {
            $category = new Category;
            $msg = [
                'status' => true,
                'message' => 'Category Successfully Added',
                'redirect' => route('category.index')
            ];
        } else {
            $msg = [
                'status' => true,
                'message' => 'Category Successfully Updated',
                'redirect' => route('category.index')
            ];
        }

        $category->name = $request->name;
        $category->status = 1;
        $category->save();
        
        return response()->json($msg);
    }



    
    public function edit($did)
    {
        $cid = Crypt::decrypt($did);
        $edits = Category::find($cid);
        $category = Category::all();

        if (!$edits) {
            return redirect()->route('category.create')->with('error', 'Category not found');
        }
    
        $data = array(
            'title' => 'Edit Category',
            'edits' => $edits,
            'category' => $category,
            'button' => 'Update'
        );
        return view('admin.category.create', $data);
    }


    public function destory(request $request)
    {
        $Category = Category::find($request->id);
        $Category->delete();
        $request->session()->flash('success','Designation deleted successfully');
        return response()->json([
            'status' => false,
            'message' => 'Category delete successfully',
        ]);
    }
}
