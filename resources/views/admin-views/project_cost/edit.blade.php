@extends('layouts.admin.app')

@section('title', translate('Update Projectcost Details'))
<style>
    .password-container{
        position: relative;
    }

    .togglePassword{
        position: absolute;
        top: 14px;
        right: 16px;
    }
</style>
@push('css_or_js')

@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="page-header">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{translate('update Projectcost Details')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.project_cost.update',[$project_cost['id']])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="input-label"
                                            for="exampleFormControlSelect1">{{translate('Project')}} {{translate('name')}}
                                        <span class="input-label-secondary">*</span></label>
                                    <select id="exampleFormControlSelect1" name="project_id" class="form-control" required>
                                        <option value="">--Select--</option>
                                        @foreach(\App\Model\Project::get() as $project)
                                            <option value="{{$project['id']}}" {{ $project->id == old('project_id', $project_cost->project_id) ? 'selected' : '' }}>{{$project['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('date')}}</label>
                                <input type="date" value="{{$project_cost['date']}}" name="date"
                                       class="form-control" placeholder="Date"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('amount')}}</label>
                                <input type="number" value="{{$project_cost['amount']}}" name="amount" class="form-control"
                                       placeholder="amount"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Description')}}</label>
                                <textarea type="text" rows="3" name="description" class="form-control" placeholder="{{translate('description')}}"
                                       required>{{$project_cost['description']}}</textarea>
                            </div>
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-primary">{{translate('submit')}}</button>
                </form>
            </div>
        </div>
    </div>

@endsection


