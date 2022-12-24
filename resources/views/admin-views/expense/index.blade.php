@extends('layouts.admin.app')

@section('title', translate('Add Expense Details'))
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
                    <h1 class=""><i class="tio-add-circle-outlined"></i> {{translate('add')}} {{translate('exepnese')}} {{translate('details')}}</h1>
                </div>
            </div>
        </div>
        <!-- End Page Header -->
        <div class="row gx-2 gx-lg-3">
            <div class="col-sm-12 col-lg-12 mb-3 mb-lg-2">
                <form action="{{route('admin.expense.store')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                         <div class="col-12 col-md-6">
                                <div class="form-group">
                                    <label class="input-label"
                                            for="exampleFormControlSelect1">{{translate('Month')}} <span class="input-label-secondary">*</span></label>
                                    <input type="month" name="month" class="form-control" placeholder="{{translate('month')}}"
                                    required>
                                </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Total Grocery expense')}}</label>
                                <input type="number" name="grocery_expense" id="grocery_expense" class="form-control" placeholder="{{translate('Grocery expense')}}"
                                       required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('Rooom Rent')}}</label>
                                <input type="number" name="room_rent" id="room_rent" class="form-control" placeholder="{{translate('Rooom Rent')}}"
                                       required>
                            </div>
                        </div>
                        <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('bike expense')}}</label>
                                <input type="number" name="bike_expense" id="bike_expense" class="form-control" placeholder="{{translate('bike expense')}}"
                                       required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                       <div class="col-md-6 col-12">
                            <div class="form-group">
                                <label class="input-label" for="exampleFormControlInput1">{{translate('total')}}</label>
                                <input type="number" name="total" id="total" class="form-control" placeholder="{{translate('total')}}"
                                       readonly>
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