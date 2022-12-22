<?php

namespace App\Http\Controllers\Admin;

use App\CentralLogics\Helpers;
use App\Http\Controllers\Controller;
use App\Model\Staff;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class StaffController extends Controller
{
    public function index()
    {
        return view('admin-views.staff.index');
    }

    public function list(Request $request)
    {
        $query_param = [];
        $search = $request['search'];
        if ($request->has('search')) {
            $key = explode(' ', $request['search']);
            $staff = Staff::where(function ($q) use ($key) {
                foreach ($key as $value) {
                    $q->orWhere('name', 'like', "%{$value}%")
                        ->orWhere('mobile', 'like', "%{$value}%")
                        ->orWhere('salary_type', 'like', "%{$value}%")
                        ->orWhere('email', 'like', "%{$value}%")
                        ->orWhere('work_type', 'like', "%{$value}%");
                }
            });
            $query_param = ['search' => $request['search']];
        }else{
            $staff = new Staff();
        }

        $staffs = $staff->latest()->paginate(Helpers::getPagination())->appends($query_param);
        return view('admin-views.staff.list', compact('staffs', 'search'));
    }

    // public function search(Request $request)
    // {
    //     $key = explode(' ', $request['search']);
    //     $staff = Staff::where(function ($q) use ($key) {
    //         foreach ($key as $value) {
    //             $q->orWhere('name', 'like', "%{$value}%")
    //                 ->orWhere('mobile', 'like', "%{$value}%")
    //                 ->orWhere('salary_type', 'like', "%{$value}%")
    //                 ->orWhere('email', 'like', "%{$value}%")
    //                 ->orWhere('work_type', 'like', "%{$value}%");
    //         }
    //     })->get();
    //     return response()->json([
    //         'view' => view('admin-views.staff.partials._table', compact('drivers'))->render()
    //     ]);
    // }

 

    public function preview($id)
    {
        $staff = Staff::where(['id' => $id])->first();
        return view('admin-views.staff.view', compact('staff'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|regex:/(.+)@(.+)\.(.+)/i|unique:staffs',
            'mobile' => 'required|unique:staffs',
            'password' => 'required',
            'salary_type' => 'required',
            'upi' => 'required',


        ], [
            'name.required' => translate('Name is required!'),
            'mobile.required' => translate('Mobile Number is required!'),

        ]);

        $staff = new Staff();
        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->mobile = $request->mobile;
        $staff->password =$request->password;
        $staff->salary_type = $request->salary_type;
        $staff->work_type = $request->work_type;
        $staff->upi = $request->upi;
        $staff->github = $request->github;
        $staff->holder_name = $request->holder_name;
        $staff->bank_name = $request->bank_name;
        $staff->account_number = $request->account_number;
        $staff->branch = $request->branch;
        $staff->ifsc_code = $request->ifsc_code;
        $staff->image = Helpers::upload('staff/', 'png', $request->file('image'));
        $staff->save();

        Toastr::success(translate('Staff added successfully!'));
        return redirect('admin/staff/list');
    }

    public function edit($id)
    {
        $staff = Staff::find($id);
        return view('admin-views.staff.edit', compact('staff'));
    }

    // public function status(Request $request)
    // {
    //     $driver = Driver::find($request->id);
    //     $driver->status = $request->status;
    //     $driver->save();
    //     Toastr::success(translate('Driver status updated!'));
    //     return back();
    // }

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

        $staff = Staff::find($id);

        if ($staff['email'] != $request['email']) {
            $request->validate([
                'email' => 'required|unique:staffs',
            ]);
        }

        if ($staff['mobile'] != $request['mobile']) {
            $request->validate([
                'mobile' => 'required|unique:staffs',
            ]);
        }

        $staff->name = $request->name;
        $staff->email = $request->email;
        $staff->mobile = $request->mobile;
        $staff->password =$request->password;
        $staff->salary_type = $request->salary_type;
        $staff->work_type = $request->work_type;
        $staff->upi = $request->upi;
        $staff->github = $request->github;
        $staff->holder_name = $request->holder_name;
        $staff->bank_name = $request->bank_name;
        $staff->account_number = $request->account_number;
        $staff->branch = $request->branch;
        $staff->ifsc_code = $request->ifsc_code;
        $staff->image = $request->has('image') ? Helpers::update('staff/', $staff->image, 'png', $request->file('image')) : $staff->image;
        $staff->save();

        Toastr::success(translate('Staff updated successfully!'));
        return redirect('admin/staff/list');
    }

    public function delete(Request $request)
    {
        $staff = Staff::find($request->id);
        if (Storage::disk('public')->exists('staff/' . $staff['image'])) {
            Storage::disk('public')->delete('staff/' . $staff['image']);
        }
        $staff->delete();
        Toastr::success(translate('Staff removed Successfully!'));
        return back();
    }
}
