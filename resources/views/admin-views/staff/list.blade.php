@extends('layouts.admin.app')

@section('title', translate('Staff List'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="pb-3">
            <div class="row align-items-center">
                <div class="col-12 flex-start">
                        <h1 class=""><i class="tio-filter-list"></i> {{translate('staff')}} {{translate('list')}}</h1>
                        <h1 class="text-primary">({{ $staffs->total() }})</h1>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <!-- Card -->
                <div class="card">
                    <!-- Header -->
                    <div class="card-header">
                        <div>
                            <form action="{{url()->current()}}" method="GET">
                                <div class="input-group">
                                    <input id="datatableSearch_" type="search" name="search"
                                           class="form-control"
                                           placeholder="{{translate('Search')}}" aria-label="Search"
                                           value="{{$search}}" required autocomplete="off">
                                    <div class="input-group-append">
                                        <button type="submit" class="input-group-text"><i class="tio-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-6 text-right">
                            <a href="{{route('admin.staff.add')}}" class="btn btn-primary pull-right"><i
                                    class="tio-add-circle"></i> {{translate('add staff')}}</a>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{translate('#')}}</th>
                                <th >{{translate('name')}}</th>
                                <th >{{translate('work Type')}}</th>
                                <th >{{translate('salary type')}}</th>
                                <th>{{translate('mobile')}}</th>
                                <th>{{translate('email')}}</th>
                                <th>{{translate('password')}}</th>
                                <th>{{translate('upi')}}</th>
                                <th>{{translate('account details')}}</th>
                                <th style="width: 25%">{{translate('profile')}}</th>
                                <th>{{translate('action')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($staffs as $key=>$staff)
                                <tr>
                                    <td>{{$staffs->firstitem()+$key}}</td>
                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{$staff['name']}}
                                        </span>
                                    </td>
                                    <td>
                                        {{$staff['work_type']}}
                                    </td>
                                    <td>
                                        {{$staff['salary_type']}}
                                    </td>
                                    <td>
                                        {{$staff['mobile']}}
                                    </td> 
                                    <td>
                                        {{$staff['email']}}
                                    </td>
                                    <td>
                                        {{$staff['password']}}
                                    </td>
                                    <td>
                                        {{$staff['upi']}}
                                    </td>
                                    <td>
                                      {{translate('account Holder')}} - {{$staff['holder_name']}} <br>
                                      {{translate('bank name')}} - {{$staff['bank_name']}} <br>
                                      {{translate('branch')}} - {{$staff['branch']}} <br>
                                      {{translate('account number')}} - {{$staff['account_number']}} <br>
                                      {{translate('ifsc code')}} - {{$staff['ifsc_code']}}
                                    </td>
                                    <td>
                                        <div style="height: 80px; width: 60px; overflow-x: hidden;overflow-y: hidden">
                                            <img width="60" style="border-radius: 50%"
                                                 onerror="this.src='{{asset('public/assets/admin/img/160x160/img1.jpg')}}'"
                                                 src="{{asset('storage/app/public/staff')}}/{{$staff['image']}}">
                                        </div>
                                    </td>
                                    <td>
                                        <!-- Dropdown -->
                                        <div class="dropdown">
                                            <button class="btn btn-secondary dropdown-toggle" type="button"
                                                    id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                <i class="tio-settings"></i>
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a class="dropdown-item"
                                                   href="{{route('admin.staff.edit',[$staff['id']])}}"> <i class="tio-edit"></i>{{translate('edit')}}</a>
                                                <a class="dropdown-item"
                                                   href="{{route('admin.staff.preview',[$staff['id']])}}"> <i class="tio-file"></i>{{translate('view')}}</a>
                                                <a class="dropdown-item" href="javascript:"
                                                   onclick="form_alert('staff-{{$staff['id']}}','{{translate('Want to remove this information ?')}}')"><i class="tio-remove-from-trash"></i>{{translate('delete')}}</a>
                                                <form action="{{route('admin.staff.delete',[$staff['id']])}}"
                                                      method="post" id="staff-{{$staff['id']}}">
                                                    @csrf @method('delete')
                                                </form>
                                            </div>
                                        </div>
                                        <!-- End Dropdown -->
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                        <div class="page-area">
                            <table>
                                <tfoot>
                                {!! $staffs->links() !!}
                                </tfoot>
                            </table>
                        </div>

                    </div>
                    <!-- End Table -->
                </div>
                <!-- End Card -->
            </div>
        </div>
    </div>

@endsection

@push('script_2')
    <script>
        $('#search-form').on('submit', function () {
            var formData = new FormData(this);
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.post({
                url: '{{route('admin.staff.search')}}',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                beforeSend: function () {
                    $('#loading').show();
                },
                success: function (data) {
                    $('#set-rows').html(data.view);
                    $('.page-area').hide();
                },
                complete: function () {
                    $('#loading').hide();
                },
            });
        });
    </script>
@endpush
