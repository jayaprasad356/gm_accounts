<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Client;
use App\Model\Project;
use App\Model\Income;
use App\Model\Translation;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

class IncomeController extends Controller
{
    public function index()
    {
        return view('admin-views.income.index');
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $income = Income::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('incomes.id', 'like', "%{$value}%")
                        ->orWhere('incomes.amount', 'like', "%{$value}%")
                        ->orWhere('projects.name', 'like', "%{$value}%")
                        ->orWhere('clients.name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $income = new Income();
        }

        $incomes = $income->join('clients', 'incomes.client_id', '=','clients.id')
        ->join('projects', 'incomes.project_id', '=','projects.id')
        ->select('incomes.id AS id','projects.name AS project_name','clients.name AS client_name','incomes.*')->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.income.list', compact('incomes', 'search'));
    }

    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $income = Income::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('id', 'like', "%{$value}%")
                    ->orWhere('date', 'like', "%{$value}%")
                    ->orWhere('amount', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin-views.income.partials._table', compact('incomes'))->render()
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'project_id' => 'required',
            'amount' => 'required',


        ], [
            'client_id.required' => translate('Client Name is required!'),
            'date.required' => translate('Date is required!'),
            'project_id.required' => translate('Project Name is required!'),

        ]);

        $id_img_names = [];

        $income = new Income();
        $income->client_id = $request->client_id;
        $income->project_id = $request->project_id;
        $income->date =Carbon::now("Asia/Kolkata")->format('Y-m-d');
        $income->amount = $request->amount;
        $income->save();

        Toastr::success(translate('Income Details added successfully!'));
        return redirect('admin/income/list');
    }

    public function edit($id)
    {
        $income = Income::find($id);
        return view('admin-views.income.edit', compact('income'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'client_id' => 'required',
            'amount' => 'required',
            'project_id' => 'required',

        ], [
            'client_id.required' => translate('Client Name is required!'),
            'date.required' => translate('Date is required!'),
            'project_id.required' => translate('Project Name is required!')
        ]);

        $income = Income::find($id);

        $income->client_id = $request->client_id;
        $income->project_id = $request->project_id;
        $income->date = Carbon::now("Asia/Kolkata")->format('Y-m-d');
        $income->amount = $request->amount;
        $income->save();

        Toastr::success(translate('Income Details updated successfully!'));
        return redirect('admin/income/list');
    }

    public function delete(Request $request)
    {
        $income = Income::find($request->id);
        $income->delete();
        Toastr::success(translate('Income Details removed Successfully!'));
        return back();
    }
}
