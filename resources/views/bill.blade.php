@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">

            @if (session()->has('success'))
                {{-- get message with close button --}}

                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>{{ session()->get('success') }}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">

                        <div class="row">
                            <div class="col-md-6">
                                {{-- current date --}}
                                Date: {{ date('l, F jS, Y') }}




                            </div>
                            <div class="col-md-6 text-end">
                                Bill No: {{ $billCount }}
                            </div>
                        </div>

                    </div>

                    <div class="card-body justify-content-end">

                        <div class="row mb-3">
                            <label for="name"
                                class="col-md-2 col-form-label text-md-end">{{ __('Costumer Name') }}</label>

                            <div class="col-md-4">
                                <input id="name" type="text"
                                    class="form-control @error('name') is-invalid @enderror" name="name"
                                    value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- address --}}

                        <div class="row mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('Address') }}</label>

                            <div class="col-md-4">
                                <textarea name="address" id="address" cols="30" rows="3"
                                    class="form-control @error('address') is-invalid @enderror" required autocomplete="address"></textarea>

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                        </div>

                        {{-- city --}}

                        <div class="row mb-3">
                            <label for="name" class="col-md-2 col-form-label text-md-end">{{ __('City') }}</label>

                            <div class="col-md-4">
                                <input type="text" name="city" id="city"
                                    class="form-control @error('city') is-invalid @enderror" required autocomplete="city">

                                @error('city')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>

                        </div>

                        {{-- add button --}}

                        <div class="row mb-3">
                            <div class="col-md-6 offset-md-4">
                                <button type="button" class="btn btn-primary" id="addCostumer"
                                    value="addCostumer">Add</button>
                            </div>
                        </div>






                        {{-- table --}}

                        <form action="{{ route('bill.store') }}" method="post">

                            @csrf

                            <input type="hidden" name="costumer_id" id="costumer_id">

                            <div class="row mb-3">



                                <div class="col-md-12">
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Sr No</th>
                                                <th>Item</th>
                                                <th>Rate</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody id="data">

                                            <tr id="row">
                                                <td>1</td>
                                                <td>
                                                    <select name="item[]" id="item1"
                                                        onchange="itemvalue(1,this.value);"
                                                        class="form-control   @error('item') is-invalid @enderror" required
                                                        autocomplete="item">
                                                        <option value="">Select Item</option>
                                                        @foreach ($items as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>

                                                    @error('item')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </td>
                                                <td>
                                                    <input type="text" name="rate[]" id="rate1"
                                                        class="form-control @error('rate') is-invalid @enderror" required
                                                        autocomplete="rate">

                                                    @error('rate')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </td>
                                                <td>
                                                    <input type="text" name="quantity[]" id="quantity1"
                                                        class="form-control @error('quantity') is-invalid @enderror"
                                                        required autocomplete="quantity">

                                                    @error('quantity')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </td>
                                                <td>
                                                    <input type="text" readonly name="amount[]" id="amount1"
                                                        class="form-control @error('amount') is-invalid @enderror" required
                                                        autocomplete="amount">

                                                    @error('amount')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror

                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-primary"
                                                        id="addrow">Add</button>
                                                </td>
                                            </tr>




                                        </tbody>
                                    </table>

                                    {{-- total amount --}}

                                    <div class="row mb-3 justify-content-end">
                                        <label for="name"
                                            class="col-md-2 col-form-label text-md-end">{{ __('Total Amount') }}</label>

                                        <div class="col-md-3">
                                            <input type="text" name="total_amount" id="total_amount"
                                                class="form-control @error('total_amount') is-invalid @enderror" required
                                                autocomplete="total_amount">

                                            @error('total_amount')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror

                                        </div>

                                    </div>



                                </div>

                            </div>







                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection


@section('script')
    <script>
        $('#addrow').on('click', function() {
            addrow();
        });

        function addrow() {
            // var n = $('#row').length;

            // length of tr in data and add 1

            var n = $('#data tr').length + 1;


            var tr = '<tr id="row' + n + '">' +
                '<td>' + (n) + '</td>' +
                '<td>' +
                '<select name="item[]" id="item" onchange="itemvalue(' + n +
                ',this.value);"   class="form-control @error('item') is-invalid @enderror" required autocomplete="item">' +
                '<option value="">Select Item</option>' +
                '@foreach ($items as $item)' +
                '<option value="{{ $item->id }}">{{ $item->name }}</option>' +
                '@endforeach' +

                '</select>' +
                '</td>' +
                '<td>' +
                '<input type="text" name="rate[]" id="rate' + (n) +
                '" class="form-control @error('rate') is-invalid @enderror" required autocomplete="rate">' +
                '</td>' +
                '<td>' +
                '<input type="text" name="quantity[]" id="quantity" class="form-control @error('quantity') is-invalid @enderror" required autocomplete="quantity">' +
                '</td>' +
                '<td>' +
                '<input type="text" readonly name="amount[]" id="amount" class="form-control @error('amount') is-invalid @enderror" required autocomplete="amount">' +
                '</td>' +
                '<td>' +
                '<button type="button" class="btn btn-danger" onclick="remove(' + n + ')">Remove</button>' +
                '</td>' +
                '</tr>';

            $('#data').append(tr);

        }


        function remove(n) {
            $('#row' + n).remove();
        }
    </script>

    <script>
        function itemvalue(row, id) {

            $.ajax({
                url: "{{ route('itemvalue') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "id": id
                },
                success: function(response) {

                    // alert(response.rate);
                    $('#rate' + row).val(response.rate);
                },
                error: function(response) {
                    console.log(response);
                }
            });

        }
    </script>

    <script>
        $(document).ready(function() {

                $('#data').on('keyup', 'input', function() {

                    var row = $(this).closest('tr');
                    var rate = row.find('input[name="rate[]"]').val();
                    var quantity = row.find('input[name="quantity[]"]').val();
                    var amount = rate * quantity;
                    row.find('input[name="amount[]"]').val(amount);

                    var total_amount = 0;
                    $('#data tr').each(function() {
                        var amount = $(this).find('input[name="amount[]"]').val();
                        total_amount = total_amount + parseInt(amount);
                    });

                    $('#total_amount').val(total_amount);

                });

            }

        );
    </script>


    <script>
        $('#name').on('keyup', function() {
            var name = $(this).val();


            $.ajax({
                url: "{{ route('getcustomer') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": name
                },
                success: function(response) {
                    if (response.customer) {
                        $('#address').val(response.customer.address);
                        $('#city').val(response.customer.city);
                        $('#costumer_id').val(response.customer.id);
                    } else {
                        $('#address').val('');
                        $('#city').val('');
                    }
                },
                error: function(response) {
                    console.log(response);
                    $('#address').val('');
                    $('#city').val('');
                }
            });
        });


        $('#name').on('blur', function() {
            if ($(this).val() == '') {
                $('#address').val('');
                $('#city').val('');
            }
        });
    </script>


    <script>
        $('#addCostumer').on('click', function() {

            const name = $('#name').val();
            const address = $('#address').val();
            const city = $('#city').val();

            $.ajax({
                url: "{{ route('addcustomer') }}",
                type: "POST",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "name": name,
                    "address": address,
                    "city": city
                },
                success: function(response) {
                    if (response.customer) {
                        $('#address').val(response.customer.address);
                        $('#city').val(response.customer.city);

                        $('#costumer_id').val(response.customer.id);

                        // toast

                        const Toast = Swal.mixin({
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 2000
                        });

                        Toast.fire({
                            icon: 'success',
                            title: 'Customer Added Successfully'
                        })




                    } else {
                        $('#address').val('');
                        $('#city').val('');
                    }
                },
                error: function(response) {
                    console.log(response);
                    $('#address').val('');
                    $('#city').val('');
                }
            });



        });
    </script>
@endsection
