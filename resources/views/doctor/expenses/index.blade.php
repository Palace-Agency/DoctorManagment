@section('title', 'Expenses')
@extends('layouts_user.master')
@section('content')

    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                @if (Session::has('success'))
                    @include('alert.success')
                @elseif(Session::has('danger'))
                    @include('alert.danger')
                @endif
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Expenses
                            <a href="{{ route('expense.create') }}" class="btn btn-primary float-end">Add expenses</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="display" id="basic-1">
                                <thead>
                                    <tr>
                                        <th><span>#</span></th>
                                        <th><span>Name of Expense</span></th>
                                        <th><span>Description</span></th>
                                        <th><span>Category Expense</span></th>
                                        <th><span>status</span></th>
                                        <th><span>amount</span></th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $id=1 @endphp
                                    @foreach ($expenses as $expense)
                                        <tr>
                                            <td>{{ $id }}</td>
                                            <td class="text-uppercase">{{ $expense->name }}</td>
                                            <td>{{ Str::limit($expense->description, 25) }}</td>
                                            <td>{{ $expense->categoryExpense->name }}</td>

                                                <td><span
                                                        class="{{ $expense->status === 'paid' ? 'badge text-bg-success' : 'badge text-bg-danger' }}"><strong>{{ $expense->status }}</strong></span>
                                                </td>

                                            <td class="text-success"><strong>{{ $expense->amount }} DH</strong></td>

                                            <td>
                                                <ul class="action">
                                                    <li class="edit "> <a
                                                            href="{{ route('expense.edit', $expense->id) }}"><i
                                                                class="icon-pencil-alt"></i></a></li>
                                                    <li class="delete">

                                                        <a href="{{ route('expense.destroy', $expense->id) }}"
                                                            onclick="confirm(event)"><i class="icon-trash"></i></a>
                                                    </li>
                                                    <li class="m-l-10">
                                                        <span class="dropdown">
                                                            <a aria-expanded="false" aria-haspopup="true" class="border-0 "
                                                                data-bs-toggle="dropdown" id="dropdownMenuButton"
                                                                type="button"><i
                                                                    class="fa fa-ellipsis-v text-black"></i></a>
                                                            <div class="dropdown-menu tx-13">
                                                                @if ($expense->status != 'paid')
                                                                    <form class="statusformexp" style="margin: 0%" data-expense-id="{{ $expense->id }}">
                                                                        @csrf
                                                                        <input type="hidden" class="status"  name="status" value="paid">
                                                                        <button class="dropdown-item" type="submit">Paid</button>
                                                                    </form>
                                                                @else
                                                                    <form class="statusformexp" style="margin: 0%"   data-expense-id="{{ $expense->id }}">
                                                                        @csrf
                                                                        <input type="hidden" class="status" name="status" value="unpaid">
                                                                        <button class="dropdown-item" type="submit">Unpaid</button>
                                                                    </form>
                                                                @endif


                                                            </div>
                                                        </span>
                                                    </li>
                                                </ul>
                                            </td>

                                        </tr>
                                        @php $id++ @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('script')
<!-- Include jQuery from a CDN -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>

    $(document).ready(function(){
        $('.statusformexp').on('submit', function(e) {
            e.preventDefault();
            var status_change = $(this).find('.status').val();
            var expense_id = $(this).data('expense-id');
            var form = $(this);
            $.ajax({
                method: "POST",
                url: "{{ route('expense.status', ['id' => ':expense_id']) }}".replace(':expense_id', expense_id),
                data: form.serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {

                    swal("", response.status, "success");
                }
            });
        });
    });




</script>


@endsection
