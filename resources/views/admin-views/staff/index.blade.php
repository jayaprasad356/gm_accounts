@extends('layouts.admin.app')

@section('title', translate('Add new staff'))
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
                    <h1 class=""><i class="tio-add-circle-outlined"></i> {{translate('add')}} {{translate('new')}} {{translate('staff')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.staff.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('name')}}</label>
                                <input type="text" name="name" class="form-control" placeholder="{{translate('name')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Mobile Number')}}</label>
                                <input type="number" name="mobile" class="form-control" placeholder="{{translate('mobile')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('email')}}</label>
                                <input type="email" name="email" class="form-control" placeholder="{{translate('email')}}"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-12">
                                <div class="form-group">
                                        <label class="input-label" for="exampleFormControlInput1">{{translate('password')}}</label>
                                        <div class="password-container">
                                            <input type="password" name="password" class="form-control pr-7" id="password"
                                                placeholder="{{translate('Password')}}" required>
                                            <i  class="tio-hidden-outlined togglePassword"></i>
                                        </div>
                                </div>
                        </div>
                        <div class='col-md-3 col-12'>
                                <label class="control-label">{{translate('Salary Type')}}</label><br>
                                <div id="status" class="btn-group">
                                    <label class="btn btn-danger" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="salary_type" value="Hourly">Hourly
                                    </label>
                                    <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="salary_type" value="Monthly">Monthly
                                    </label>
                                </div>
                        </div>
                        <div class="col-md-4 col-12">
                                <div class="form-group">
                                    <label class="input-label" for="exampleFormControlInput1">{{translate('Work')}} {{translate('type')}}</label>
                                    <select name="work_type" class="form-control" required>
                                        <option value="Intern">{{translate('Intern')}}</option>
                                        <option value="Full-Time">{{translate('Full Time')}}</option>
                                    </select>
                                </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-12"> 
                           <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Github Link')}}</label>
                                <input type="text" name="github" class="form-control" placeholder="{{translate('github')}}"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                                <label>{{translate('Profile')}} {{translate('image')}}</label><small style="color: red">* ( {{translate('ratio')}} 1:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg3" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*" required>
                                    <label class="custom-file-label" for="customFileEg3">{{translate('choose')}} {{translate('file')}}</label>
                                </div>
                                <center>
                                    <img style="height: 200px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer3"
                                        src="{{asset('public/assets/admin/img/400x400/img2.jpg')}}" alt="profile image"/>
                                </center>
                   </div>
                    <br>
                    <h5 style="color:#3d3fad;">Account Details:</h5> <br>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Account Holder Name')}}</label>
                                <input type="text" name="holder_name" class="form-control" placeholder="{{translate('account holder')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Bank Name')}}</label>
                                <input type="text" name="bank_name" class="form-control" placeholder="{{translate('bank name')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('branch')}}</label>
                                <input type="text"  name="branch" class="form-control" placeholder="{{translate('branch')}}"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Account Number')}}</label>
                                <input type="number" name="account_number" class="form-control" placeholder="{{translate('account number')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('IFSC Code')}}</label>
                                <input type="text" name="ifsc_code" class="form-control" placeholder="{{translate('ifsc')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Upi')}}</label>
                                <input type="text"  name="upi" class="form-control" placeholder="{{translate('upi')}}"
                                       required>
                            </div>
                        </div>
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

        $("#customFileEg3").change(function () {
            readURL(this, 'viewer3');
        });
    </script>

    <script src="{{asset('public/assets/admin/js/spartan-multi-image-picker.js')}}"></script>
    <script type="text/javascript">
        $('.togglePassword').on('click', function (e) {
            console.log("fired")
            const password = $(this).siblings('input');
            password.attr('type') === 'password' ? $(this).addClass('tio-visible-outlined').removeClass('tio-hidden-outlined') :$(this).addClass('tio-hidden-outlined').removeClass('tio-visible-outlined');
            const type = password.attr('type') === 'password' ? 'text' : 'password';
            password.attr('type', type);
        });
    </script>
    <script>
         $('#btnClear').on('click', function() {
        for (instance in CKEDITOR.instances) {
            CKEDITOR.instances[instance].setData('');
        }
        }); 
    </script>
@endpush
