@extends('layouts.admin.app')

@section('title', translate('Update Expense details'))
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
                    <h1 class="page-header-title"><i class="tio-edit"></i> {{translate('update Expense details')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.expense.update',[$expense['id']])}}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="input-label"
                                            for="exampleFormControlSelect1">{{translate('month')}}
                                        <span class="input-label-secondary">*</span></label>
                                    <input type="month" name="month" class="form-control"  value="{{$expense['month']}}" placeholder="month"
                                    required>
                                 
                                </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Total Grocery expense')}}</label>
                                <input type="number" name="grocery_expense" id="grocery_expense" class="form-control"  value="{{$expense['grocery_expense']}}" placeholder="Grocery expense"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Room rent')}}</label>
                                <input type="number" id="room_rent" value="{{$expense['room_rent']}}" name="room_rent"
                                       class="form-control" placeholder="Room rent"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Bike Expense')}}</label>
                                <input type="number" id="bike_expense" value="{{$expense['bike_expense']}}" name="bike_expense" class="form-control"
                                       placeholder="Bike Expense"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Total Expense')}}</label>
                                <input type="number" id="total" value="{{$expense['total']}}" name="total" class="form-control"
                                       readonly>
                            </div>
                        </div>
                    </div>
                
                    <button type="submit" class="btn btn-primary">{{translate('submit')}}</button>
                </form>
            </div>
        </div>
    </div>

@endsection


<!--Calculate sum using Javascript without external link -->
@push('script_2')
        <script type="text/javascript">
                    var grocery_expense = document.getElementById('grocery_expense');
                    var room_rent = document.getElementById('room_rent');
                    var bike_expense = document.getElementById('bike_expense');
                    var total = document.getElementById('total'); 

                    bike_expense.addEventListener('change',calculateSum);
                    room_rent.addEventListener('change',calculateSum);
                    grocery_expense.addEventListener('change',calculateSum);

                    function calculateSum() {
                    var grocery_expense_value = parseInt(grocery_expense.value);
                    var room_rent_value = parseInt(room_rent.value);
                    var bike_expense_value = parseInt(bike_expense.value);


                    var sum = grocery_expense_value + room_rent_value + bike_expense_value;
                    total.value =sum;
                    }

</script>

@endpush