@extends('layouts.admin.app')

@section('title', translate('Expense details List'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="pb-3">
            <div class="row align-items-center">
             
                    <div class="col-12 pb-4 flex-start">
                        <h1 class=""><i class="tio-filter-list"></i> {{translate('Expense')}} {{translate('details')}}</h1>
                        <h1 class="text-primary">({{ $expenses->total() }})</h1>
                    </div>
                   <!---filter by month --->
                    <div class="col-md-3 col-sm-4">
                        <label class="input-label"
                                            for="exampleFormControlSelect1">{{translate('select')}} {{translate('month')}}
                         </label>
                         <input type="month" name="month" id="month" class="form-control" placeholder="{{translate('month')}}">
                    </div>
                   <!---end filter---->
     
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
                            <a href="{{route('admin.expense.add')}}" class="btn btn-primary pull-right"><i
                                    class="tio-add-circle"></i> {{translate('add expense')}}</a>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{translate('#')}}</th>
                                <th >{{translate('month')}}</th>
                                <th>{{translate('Total Grocery Expense')}}</th>
                                <th>{{translate('Room rent')}}</th>
                                <th>{{translate('Bike Expense')}}</th>
                                <th>{{translate('total')}}</th>
                                <th>{{translate('action')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($expenses as $key=>$expense)
                                <tr>
                                    <td>{{$expenses->firstitem()+$key}}</td>
                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{$expense['month']}}
                                        </span>
                                    </td>
                                    <td>
                                        {{$expense['grocery_expense']}}
                                    </td>
                                    <td>
                                        {{$expense['room_rent']}}
                                    </td>
                                    <td>
                                        {{$expense['bike_expense']}}
                                    </td>
                                    <td>
                                        {{$expense['total']}}
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
                                                   href="{{route('admin.expense.edit',[$expense['id']])}}"> <i class="tio-edit"></i>{{translate('edit')}}</a>
                                                <a class="dropdown-item" href="javascript:"
                                                   onclick="form_alert('expense-{{$expense['id']}}','{{translate('Want to remove this information ?')}}')"><i class="tio-remove-from-trash"></i>{{translate('delete')}}</a>
                                                <form action="{{route('admin.expense.delete',[$expense['id']])}}"
                                                      method="post" id="expense-{{$expense['id']}}">
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
                                {!! $expenses->links() !!}
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
                url: '{{route('admin.expense.search')}}',
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
     <script>
        $(document).on('ready', function () {

            var datatable = $('.table').DataTable({
                "paging": false
            });

            $('#month').on('change', function () {
                datatable
                    .columns(1)
                    .search(this.value)
                    .draw();
            });
        });
    </script>
@endpush
