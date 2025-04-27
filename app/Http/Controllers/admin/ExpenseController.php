<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Expense;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\DB;

class ExpenseController extends Controller
{
    public function index(Request $request)
    {
        $category = Category::all();
        $query = Expense::query()->with('category');

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $expenses = $query->get(); // move ->get() AFTER filtering

        $data = [
            'title' => 'Add Expense',
            'category' => $category,
            'expenses' => $expenses,
        ];

        return view('admin.expense.index', $data);
    }


    public function store(Request $request)
    {
        
        $rules = [
            'category' => 'required',
            'title' => 'required',
            'amount' => 'required|numeric',
            'date' => 'required|date',
            'description' => 'nullable|string|max:255',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return ['errors' => $validator->errors()];
        }

        $expense = new Expense();
        $expense->category_id = $request->category;
        $expense->title = $request->title;
        $expense->date = $request->date;
        $expense->amount = $request->amount;
        $expense->description = $request->description;
        $expense->save();

        $msg = [
            'status' => true,
            'message' => 'Expense Successfully Updated',
            'redirect' => route('expense.index')
        ];

        return response()->json($msg);
    }

    public function edit($id)
    {
        // Handle the expense editing logic here
    }

    public function update(Request $request, $id)
    {
        // Handle the expense updating logic here
    }

    public function destory(request $request)
    {
        $Expense = Expense::find($request->id);
        $Expense->delete();
        $request->session()->flash('success','Expense deleted successfully');
        return response()->json([
            'status' => false,
            'message' => 'Expense delete successfully',
            'redirect' => route('expense.index')
        ]);
    }



    public function ExpenseMonthlyReport(Request $request)
    {
        $category = Category::all();

        $query  = DB::table('expenses')
        ->select(
            DB::raw('YEAR(date) as year'),
            DB::raw('MONTH(date) as month'),
            'categories.name as category_name',
            DB::raw('SUM(amount) as total_expense')
        )
        ->join('categories', 'expenses.category_id', '=', 'categories.id')
        ->groupBy('year', 'month', 'categories.name')
        ->orderBy('year', 'desc')
        ->orderBy('month', 'desc')
        ->orderBy('categories.name');

        // 🔥 Apply Category Filter if selected
        if ($request->has('category') && $request->category != '') {
            $query->where('expenses.category_id', $request->category);
        }

        $monthlyCategoryExpenses = $query->get();

        $data = array(
            'title' => 'Monthly Report',
            'category' => $category,
            'monthlyCategoryExpenses' => $monthlyCategoryExpenses,
            'selectedCategory' => $request->category, 
        );

       return view('admin.expense.monthlyReport', $data);
    }
}
