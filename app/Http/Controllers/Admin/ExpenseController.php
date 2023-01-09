<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\Expense;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ExpenseController extends Controller
{
    public function index()
    {
        return view('admin-views.expense.index');
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $expense = Expense::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('month', 'like', "%{$value}%")
                        ->orWhere('id', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $expense = new Expense();
        }

        $expenses = $expense->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.expense.list', compact('expenses', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'month' => 'required',


        ], [
            'month.required' => translate('Month is required!'),

        ]);

        $id_img_names = [];

        $expense = new Expense();
        $expense->month = $request->month;
        $expense->grocery_expense = $request->grocery_expense;
        $expense->room_rent = $request->room_rent;
        $expense->bike_expense = $request->bike_expense;
        $expense->total = $request->total;
        $expense->save();

        Toastr::success(translate('Expense Details added successfully!'));
        return redirect('admin/expense/list');
    }

    public function edit($id)
    {
        $expense = Expense::find($id);
        return view('admin-views.expense.edit', compact('expense'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'month' => 'required',
         

        ], [
            'month.required' => translate('Month is required!'),
         
        ]);

        $expense = Expense::find($id);

        $expense->month = $request->month;
        $expense->grocery_expense = $request->grocery_expense;
        $expense->room_rent = $request->room_rent;
        $expense->bike_expense = $request->bike_expense;
        $expense->total = $request->total;
        $expense->save();

        Toastr::success(translate('Expense Details updated successfully!'));
        return redirect('admin/expense/list');
    }

    public function delete(Request $request)
    {
        $expense = Expense::find($request->id);
        $expense->delete();
        Toastr::success(translate('Expense Details removed Successfully!'));
        return back();
    }


    public function balancelist(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        // if ($request->has('search')) {
        //     $key = explode(' ', $request['search']);
        //     $balance = DB::where(function ($q) use ($key) {
        //         foreach ($key as $value) {
        //             $q->orWhere('project.name', 'like', "%{$value}%")
        //                 ->orWhere('projects.date', 'like', "%{$value}%")
        //                 ->orWhere('projects.description', 'like', "%{$value}%")
        //                 ->orWhere('clients.name', 'like', "%{$value}%");
        //         }
        //     });
        //     $query_param = ['search' => $request['search']];
        // }else{
        //     $project = new Project();
        // }

        $balances = DB::table('project_costs')
        ->join('projects', 'project_costs.project_id', '=','projects.id')
        ->join('incomes', 'incomes.project_id', '=','project_costs.project_id')
        ->select('project_costs.project_id AS project_id','projects.name AS project_name','project_costs.amount AS total_amount',DB::raw('SUM(incomes.amount) AS income'),DB::raw('project_costs.amount - SUM(incomes.amount) AS balance'))
        ->groupBy('project_costs.project_id','projects.name','project_costs.amount')
        ->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.balance.list', compact('balances', 'search'));
    }
}
