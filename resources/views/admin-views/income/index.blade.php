@extends('layouts.admin.app')

@section('title', translate('Add Income Details'))
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
        <div class="pb-3">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0">
                    <h1 class=""><i class="tio-add-circle-outlined"></i> {{translate('add')}} {{translate('income')}} {{translate('deatils')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.income.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="input-label"
                                            for="exampleFormControlSelect1">{{translate('project')}} {{translate('name')}}
                                        <span class="input-label-secondary">*</span></label>
                                    <select id="exampleFormControlSelect1" name="project_id" class="form-control" required>
                                        <option value="">-select-</option>
                                        @foreach(\App\Model\Project::get() as $project)
                                            <option value="{{$project['id']}}">{{$project['name']}}</option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('amount')}}</label>
                                <input type="number" name="amount" class="form-control" placeholder="{{translate('amount')}}"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                                <label>{{translate('Receipt')}} {{translate('image')}}</label><small style="color: red">* ( {{translate('ratio')}} 1:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg1" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                    <label class="custom-file-label" for="customFileEg1">{{translate('choose')}} {{translate('file')}}</label>
                                </div>
                                <center>
                                    <img style="height: 200px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer1"
                                        src="{{asset('public/assets/admin/img/400x400/img2.jpg')}}" alt="Feceipt image"/>
                                </center>
                   </div>
                    <button type="submit" class="btn btn-primary">{{translate('submit')}}</button>
                    <input type="reset" onClick="refreshPage()" class="btn-warning btn" value="Clear" />
                </form>
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        function readURL(input, viewer_id) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function (e) {
                    $('#'+viewer_id).attr('src', e.target.result);
                }

                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#customFileEg1").change(function () {
            readURL(this, 'viewer1');
        });
    </script>

   
@endpush