<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Client;
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

class ClientController extends Controller
{
    public function index()
    {
        return view('admin-views.client.index');
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $client = Client::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('mobile', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%")
                        ->orWhere('place', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $client = new Client();
        }

        $clients = $client->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.client.list', compact('clients', 'search'));
    }

    public function search(Request $request)
    {
        $key = explode(' ', $request['search']);
        $client = Client::where(function ($q) use ($key) {
            foreach ($key as $value) {
                $q->orWhere('name', 'like', "%{$value}%")
                    ->orWhere('mobile', 'like', "%{$value}%")
                    ->orWhere('email', 'like', "%{$value}%")
                    ->orWhere('place', 'like', "%{$value}%");
            }
        })->get();
        return response()->json([
            'view' => view('admin-views.client.partials._table', compact('clients'))->render()
        ]);
    }


    public function preview($id)
    {
        $client = Client::where(['id' => $id])->first();
        return view('admin-views.client.view', compact('client'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:clients',
            'mobile' => 'required|unique:clients',
            'place' => 'required',


        ], [
            'name.required' => translate('Name is required!'),
            'email.required' => translate('Email Id is required!'),
            'place.required' => translate('Place is required!'),

        ]);

        $id_img_names = [];

        $client = new Client();
        $client->name = $request->name;
        $client->place = $request->place;
        $client->email = $request->email;
        $client->mobile = $request->mobile;
        $client->save();

        Toastr::success(translate('Client added successfully!'));
        return redirect('admin/client/list');
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('admin-views.client.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i',
        ], [
            'name.required' => translate('First name is required!'),
            'mobile.required' => translate('Mobile Number is required!'),
            'email.required' => translate('Email Id is required!')
        ]);

        $client = Client::find($id);

        if ($client['email'] != $client['email']) {
            $request->validate([
                'email' => 'required|unique:clients',
            ]);
        }

        if ($client['mobile'] != $client['mobile']) {
            $request->validate([
                'mobile' => 'required|unique:clients',
            ]);
        }

        $client->name = $request->name;
        $client->email = $request->email;
        $client->mobile = $request->mobile;
        $client->place = $request->place;
        $client->save();

        Toastr::success(translate('Client updated successfully!'));
        return redirect('admin/client/list');
    }

    public function delete(Request $request)
    {
        $client = Client::find($request->id);
        $client->delete();
        Toastr::success(translate('Client removed Successfully!'));
        return back();
    }
}
