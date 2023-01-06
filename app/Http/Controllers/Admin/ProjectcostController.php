<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Project;
use App\Model\ProjectCost;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use Rap2hpoutre\FastExcel\FastExcel;

class ProjectcostController extends Controller
{
    public function index()
    {
        return view('admin-views.project_cost.index');
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $project_cost = ProjectCost::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('projects.name', 'like', "%{$value}%")
                        ->orWhere('project_costs.amount', 'like', "%{$value}%")
                        ->orWhere('project_costs.description', 'like', "%{$value}%")
                        ->orWhere('project_costs.date', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $project_cost = new ProjectCost();
        }

        $project_costs = $project_cost->join('projects', 'project_costs.project_id', '=','projects.id')
        ->select('project_costs.id AS id','project_costs.*','projects.name AS project_name')
        ->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.project_cost.list', compact('project_costs', 'search'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'project_id' => 'required',
            'amount' => 'required',
            'date' => 'required',
            'description' => 'required',


        ], [
            'project_id.required' => translate('Project Id is required!'),
            'date.required' => translate('Date is required!'),
            'description.required' => translate('Description is required!'),

        ]);

        $id_img_names = [];

        $project_cost = new ProjectCost();
        $project_cost->project_id = $request->project_id;
        $project_cost->date = $request->date;
        $project_cost->amount = $request->amount;
        $project_cost->description = $request->description;
        $project_cost->save();

        Toastr::success(translate('Project Cost Details added successfully!'));
        return redirect('admin/project_cost/list');
    }

    public function edit($id)
    {
        $project_cost = ProjectCost::find($id);
        return view('admin-views.project_cost.edit', compact('project_cost'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'project_id' => 'required',
            'date' => 'required',
            'description' => 'required',
            'amount' => 'required',

        ], [
            'amount.required' => translate('Amount is required!'),
            'date.required' => translate('Date is required!'),
            'description.required' => translate('Description is required!')
        ]);

        $project_cost = ProjectCost::find($id);

        $project_cost->project_id = $request->project_id;
        $project_cost->date = $request->date;
        $project_cost->amount = $request->amount;
        $project_cost->description = $request->description;
        $project_cost->save();

        Toastr::success(translate('Project Cost Details updated successfully!'));
        return redirect('admin/project_cost/list');
    }

    public function delete(Request $request)
    {
        $project_cost = ProjectCost::find($request->id);
        $project_cost->delete();
        Toastr::success(translate('ProjectCost Details removed Successfully!'));
        return back();
    }
}
