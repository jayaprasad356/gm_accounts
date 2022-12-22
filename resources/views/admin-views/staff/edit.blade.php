@extends('layouts.admin.app')

@section('title', translate('Update Staff'))
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
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{translate('update satff')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.staff.update',[$staff['id']])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('name')}}</label>
                                <input type="text" value="{{$staff['name']}}" name="name"
                                       class="form-control" placeholder="name"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('mobile number')}}</label>
                                <input type="number" value="{{$staff['mobile']}}" name="mobile"
                                       class="form-control" placeholder="Mobile Number"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('email')}}</label>
                                <input type="email" value="{{$staff['email']}}" name="email" class="form-control"
                                       placeholder="Ex : ex@example.com"
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
                                    <i class="tio-hidden-outlined togglePassword"></i>
                                </div>
                            </div>
                        </div>
                        <div class='col-md-3 col-12'>
                                <label class="control-label">Salary Type</label><br>
                                <div id="status" class="btn-group">
                                    <label class="btn btn-primary" data-toggle-class="btn-default" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="salary_type" value="Hourly" <?= ($staff['salary_type']== "Hourly") ? 'checked' : ''; ?>>Hourly
                                    </label>
                                    <label class="btn btn-success" data-toggle-class="btn-primary" data-toggle-passive-class="btn-default">
                                        <input type="radio" name="salary_type" value="Monthly" <?= ($staff['salary_type'] == "Monthly") ? 'checked' : ''; ?>> Monthly
                                    </label>
                                </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                 <label class="input-label" for="exampleFormControlInput1">{{translate('tax')}} {{translate('type')}}</label>
                                    <select name="work_type" class="form-control js-select2-custom">
                                        <option value="Intern" {{$staff['work_type']=='Intern'?'selected':''}}>{{translate('Intern')}}
                                        </option>
                                        <option value="Full-Time" {{$staff['work_type']=='Full-Time'?'selected':''}}>{{translate('Full Time')}}
                                        </option>
                                    </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('github link')}}</label>
                                <input type="text" value="{{$staff['github']}}" name="github" class="form-control"
                                       placeholder="github link"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                                <label>{{translate('Profile')}} {{translate('image')}}</label><small style="color: red">* ( {{translate('ratio')}} 1:1 )</small>
                                <div class="custom-file">
                                    <input type="file" name="image" id="customFileEg3" class="custom-file-input"
                                        accept=".jpg, .png, .jpeg, .gif, .bmp, .tif, .tiff|image/*">
                                    <label class="custom-file-label" for="customFileEg3">{{translate('choose')}} {{translate('file')}}</label>
                                </div>
                                <center>
                                    <img style="height: 200px;border: 1px solid; border-radius: 10px;margin-top:10px;" id="viewer3"
                                        src="{{asset('storage/app/public/staff').'/'.$staff['image']}}" alt="profile image"/>
                                </center>
                   </div>
                   <br>
                    <h5 style="color:#3d3fad;">Account Details:</h5> <br>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('account holder name')}}</label>
                                <input type="text" value="{{$staff['holder_name']}}" name="holder_name" class="form-control"
                                       placeholder="holder"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('bank name')}}</label>
                                <input type="text" value="{{$staff['bank_name']}}" name="bank_name"
                                       class="form-control" placeholder="bank_name"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('branch')}}</label>
                                <input type="text" value="{{$staff['branch']}}" name="branch"
                                       class="form-control" placeholder="branch"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('accout number')}}</label>
                                <input type="number" value="{{$staff['account_number']}}" name="account_number" class="form-control"
                                       placeholder="Account number"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('ifsc code')}}</label>
                                <input type="text" value="{{$staff['ifsc_code']}}" name="ifsc_code"
                                       class="form-control" placeholder="ifsc_code"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-4 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('upi')}}</label>
                                <input type="text" value="{{$staff['upi']}}" name="upi"
                                       class="form-control" placeholder="upi"
                                       required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">{{translate('submit')}}</button>
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
        /*==================================
       togglePassword
      ====================================*/
        $('.togglePassword').on('click', function (e) {
            console.log("fired")
            const password = $(this).siblings('input');
            password.attr('type') === 'password' ? $(this).addClass('tio-visible-outlined').removeClass('tio-hidden-outlined') :$(this).addClass('tio-hidden-outlined').removeClass('tio-visible-outlined');
            const type = password.attr('type') === 'password' ? 'text' : 'password';
            password.attr('type', type);
        });
    </script>
@endpush
