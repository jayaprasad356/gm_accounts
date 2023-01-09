<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Client;
use App\Model\Project;
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

class ProjectController extends Controller
{
    public function index()
    {
        return view('admin-views.project.index');
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $project = Project::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('projects.name', 'like', "%{$value}%")
                        ->orWhere('projects.date', 'like', "%{$value}%")
                        ->orWhere('projects.description', 'like', "%{$value}%")
                        ->orWhere('clients.name', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $project = new Project();
        }

        $projects = $project->join('clients', 'projects.client_id', '=','clients.id')
        ->select('projects.id AS id','projects.*','clients.name AS client_name')
        ->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.project.list', compact('projects', 'search'));
    }

    // public function search(Request $request)
    // {
    //     $key = explode(' ', $request['search']);
    //     $project = Project::where(function ($q) use ($key) {
    //         foreach ($key as $value) {
    //             $q->orWhere('name', 'like', "%{$value}%")
    //                 ->orWhere('date', 'like', "%{$value}%")
    //                 ->orWhere('description', 'like', "%{$value}%");
    //         }
    //     })->get();
    //     return response()->json([
    //         'view' => view('admin-views.project.partials._table', compact('projects'))->render()
    //     ]);
    // }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'description' => 'required',


        ], [
            'name.required' => translate('Name is required!'),
            'date.required' => translate('Date is required!'),
            'description.required' => translate('Description is required!'),

        ]);

        $id_img_names = [];

        $project = new Project();
        $project->client_id = $request->client_id;
        $project->name = $request->name;
        $project->date = $request->date;
        $project->description = $request->description;
        $project->save();

        Toastr::success(translate('Project added successfully!'));
        return redirect('admin/project/list');
    }

    public function edit($id)
    {
        $project = Project::find($id);
        return view('admin-views.project.edit', compact('project'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'date' => 'required',
            'description' => 'required',
            'client_id' => 'required',

        ], [
            'name.required' => translate('Name is required!'),
            'date.required' => translate('Date is required!'),
            'description.required' => translate('Description is required!')
        ]);

        $project = Project::find($id);

        $project->client_id = $request->client_id;
        $project->name = $request->name;
        $project->date = $request->date;
        $project->description = $request->description;
        $project->save();

        Toastr::success(translate('Project updated successfully!'));
        return redirect('admin/project/list');
    }

    public function delete(Request $request)
    {
        $project = Project::find($request->id);
        $project->delete();
        Toastr::success(translate('Project removed Successfully!'));
        return back();
    }
}
