@extends('layouts.admin.app')

@section('title', translate('Client List'))

@push('css_or_js')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    <div class="content container-fluid">
        <!-- Page Header -->
        <div class="pb-3">
            <div class="row align-items-center">
                <div class="col-sm mb-2 mb-sm-0 row">
                    <div class="col-12 col-sm-6">
                        <h1 class=""><i class="tio-filter-list"></i> {{translate('client')}} {{translate('list')}}</h1>
                    </div>
{{--                    <div class="col-0 col-sm-4 col-md-6"></div>--}}
                    <div class="col-12 col-sm-6 text-sm-right text-left">
                        <a href="{{route('admin.client.add')}}" class="btn btn-primary pull-right"><i
                                class="tio-add-circle"></i> {{translate('add Client')}}</a>
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
                    <div class="card-header flex-between">
                        <div class="flex-start">
                            <h5 class="card-header-title">{{translate('Clients Table')}}</h5>
                            <h5 class="card-header-title text-primary mx-1">({{ $clients->total() }})</h5>
                        </div>
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
                    </div>
                    <!-- End Header -->

                    <!-- Table -->
                    <div class="table-responsive datatable-custom">
                        <table class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table">
                            <thead class="thead-light">
                            <tr>
                                <th>{{translate('#')}}</th>
                                <th >{{translate('name')}}</th>
                                <th>{{translate('mobile')}}</th>
                                <th>{{translate('email')}}</th>
                                <th>{{translate('Place')}}</th>
                                <th>{{translate('action')}}</th>
                            </tr>
                            </thead>

                            <tbody id="set-rows">
                            @foreach($clients as $key=>$client)
                                <tr>
                                    <td>{{$clients->firstitem()+$key}}</td>
                                    <td>
                                        <span class="d-block font-size-sm text-body">
                                            {{$client['name']}}
                                        </span>
                                    </td>
                                    <td>
                                        {{$client['mobile']}}
                                    </td>
                                    <td>
                                        {{$client['email']}}
                                    </td>
                                    <td>
                                        {{$client['place']}}
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
                                                   href="{{route('admin.client.edit',[$client['id']])}}"> <i class="tio-edit"></i>{{translate('edit')}}</a>
                                                <a class="dropdown-item"
                                                   href="{{route('admin.client.preview',[$client['id']])}}"> <i class="tio-file"></i>{{translate('view')}}</a>
                                                <a class="dropdown-item" href="javascript:"
                                                   onclick="form_alert('client-{{$client['id']}}','{{translate('Want to remove this information ?')}}')"><i class="tio-remove-from-trash"></i>{{translate('delete')}}</a>
                                                <form action="{{route('admin.client.delete',[$client['id']])}}"
                                                      method="post" id="client-{{$client['id']}}">
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
                                {!! $clients->links() !!}
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
                url: '{{route('admin.client.search')}}',
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
