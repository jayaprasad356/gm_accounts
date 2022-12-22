@extends('layouts.admin.app')

@section('title', translate('Staff Details'))

@push('css_or_js')

@endpush

@section('content')
<div class="content container-fluid">
        <!-- Page Header -->
        <div class="pb-3">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class=""> {{translate('Staff')}} {{translate('details')}}</h1>
                </div>
                <div class="col-sm mb-2 mb-sm-0">
                    <a href="{{url()->previous()}}" class="btn btn-primary float-right">
                        <i class="tio-back-ui"></i> {{translate('back')}}
                    </a>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-md-6 col-12 mb-3 mb-lg-2">
                <table class="table table-bordered">
                            <tr>
                                <th style="width: 200px">ID</th>
                                <td>{{$staff['id']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Name</th>
                                <td>{{$staff['name']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Mobile Number</th>
                                <td>{{$staff['mobile']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Email</th>
                                <td>{{$staff['email']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Profile</th>
                                <td>
                                <img style="height: 80px;width:80px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer"
                                        onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                        src="{{asset('storage/app/public/staff').'/'.$staff['image']}}" alt="driver image"/>
                                </td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Work Type</th>
                                <td>{{$staff['work_type']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Salary Type</th>
                                <td>{{$staff['salary_type']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Github Link</th>
                                <td> <a href="{{$staff['github']}}">{{$staff['github']}}</a></td>
                            </tr>
                </table>
            </div>
            <div class="col-md-6 col-12 mb-3 mb-lg-2">
                <table class="table table-bordered">
                    <h4 style="color:#00bfff;">Account Details:</h5>
                            <tr>
                                <th style="width: 200px">Bank Name</th>
                                <td>{{$staff['bank_name']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Branch Name</th>
                                <td>{{$staff['branch']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">Account Number</th>
                                <td>{{$staff['account_number']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">IFSC Code</th>
                                <td>{{$staff['ifsc_code']}}</td>
                            </tr>
                            <tr>
                                <th style="width: 200px">UPI</th>
                                <td>{{$staff['upi']}}</td>
                            </tr>
                </table>
                
            </div>
        </div>
    </div>
@endsection

@push('script_2')

@endpush
