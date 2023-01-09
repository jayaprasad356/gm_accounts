@extends('layouts.admin.app')

@section('title', translate('Project List'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="pb-3">
            <div class="row align-items-center">
             
                    <div class="col-12 pb-4 flex-start">
                        <h1 class=""><i class="tio-filter-list"></i> {{translate('Project')}} {{translate('list')}}</h1>
                        <h1 class="text-primary">({{ $projects->total() }})</h1>
                    </div>
                   
                    <div class="col-md-3 col-sm-4">
                        <!-- Select -->
                        <label class="input-label"
                                            for="exampleFormControlSelect1">{{translate('select')}} {{translate('client')}}
                         </label>
                        <select id="client_id" class="js-select2-custom"
                                            data-hs-select2-options='{
                                              "minimumResultsForSearch": "Infinity",
                                              "customClass": "custom-select custom-select-sm text-capitalize"
                                            }'>
                            <option disabled>--- {{translate('select')}} {{translate('client')}} ---</option>
                            <option value="">{{translate('all')}}</option>
                            @foreach(\App\Model\Client::all() as $client)
                                <option
                                    value="{{$client['id']}}">{{$client['name']}}</option>
                            @endforeach
                        </select>
                        <!-- End Select -->
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
                            <a href="{{route('admin.project.add')}}" class="btn btn-primary pull-right"><i
                                    class="tio-add-circle"></i> {{translate('add project')}}</a>
                        </div>
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{translate('#')}}</th>
                                <th >{{translate('client name')}}</th>
                                <th>{{translate('project')}}</th>
                                <th>{{translate('date')}}</th>
                                <th>{{translate('description')}}</th>
                                <th>{{translate('action')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($projects as $key=>$project)
                                <tr>
                                    <td>{{$projects->firstitem()+$key}}</td>
                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{$project['client_name']}}
                                        </span>
                                    </td>
                                    <td>
                                        <label class="badge badge-soft-info">{{$project['name']}}</label>
                                    </td>
                                    <td>
                                        {{$project['date']}}
                                    </td>
                                    <td>
                                        {{$project['description']}}
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
                                                   href="{{route('admin.project.edit',[$project['id']])}}"> <i class="tio-edit"></i>{{translate('edit')}}</a>
                                                <a class="dropdown-item" href="javascript:"
                                                   onclick="form_alert('project-{{$project['id']}}','{{translate('Want to remove this information ?')}}')"><i class="tio-remove-from-trash"></i>{{translate('delete')}}</a>
                                                <form action="{{route('admin.project.delete',[$project['id']])}}"
                                                      method="post" id="project-{{$project['id']}}">
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
                                {!! $projects->links() !!}
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
                url: '{{route('admin.project.search')}}',
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
            // INITIALIZATION OF DATATABLES
            // =======================================================
            // var datatable = $.HSCore.components.HSDatatables.init($('#columnSearchDatatable'));

            var datatable = $('.table').DataTable({
                "paging": false
            });

            // $('#column1_search').on('keyup', function () {
            //     datatable
            //         .columns(1)
            //         .search(this.value)
            //         .draw();
            // });


            $('#client_id').on('change', function () {
                datatable
                    .columns(2)
                    .search(this.value)
                    .draw();
            });


            // INITIALIZATION OF SELECT2
            // =======================================================
            $('.js-select2-custom').each(function () {
                var select2 = $.HSCore.components.HSSelect2.init($(this));
            });
        });
    </script>
@endpush
