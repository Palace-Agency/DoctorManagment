@section('title', 'Create Expenses')
@extends('layouts_user.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h4>
                            Add expense
                            <a href="{{ route('expense.index') }}" class="btn btn-primary float-end">Back</a>
                        </h4>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{route('expense.store')}}" class="form">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-contol">
                                        <label>Name of Category Expense :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <select class="form-control select2 select2-accessible" aria-label="Default select example" name='category_expenses_id'>
                                            <option disabled selected>Choose category</option>
                                            @if($categoryexps)
                                                @foreach($categoryexps as $categoryexp)
                                                    <option value="{{ $categoryexp->id }}">{{ $categoryexp->name }}</option>
                                                @endforeach
                                            @else
                                                <option value="" disabled>No categories available</option>
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label>Name of Expense :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="text" name="name" class="form-control @error('name') is-invalid @enderror">
                                        @error('name')
                                            <span class="text-danger" role="alert">
                                                <strong>{{$message}}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">

                                        <label>Amount of Expense :
                                            <span class="text-danger">*</span>
                                        </label>
                                        <input type="number" class="form-control @error('amount') is-invalid @enderror" name="amount" required="">
                                        @error('amount')
                                        <span class="text-danger" role="alert">
                                            <strong>{{$message}}</strong>
                                        </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mt-2">
                                <label>Description :</label>
                                <textarea class="form-control" rows="3" name="description"></textarea>
                                @error('description')
                                <span class="text-danger" role="alert">
                                <strong>{{$message}}</strong>
                                </span>
                                @enderror
                                <div class="invalid-feedback">
                                Please enter description
                                </div>
                            </div>



                            <div class="form-group mt-2">
                                <label>Status <span class="text-danger">*</span></label>
                                <div class="form-check">
                                    <input class="form-check-input" name="status" type="radio" value="paid">
                                    <label class="form-check-label">
                                    Paid
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" name="status"  type="radio" value="unpaid" checked>
                                    <label class="form-check-label" >
                                    Unpaid
                                    </label>
                                </div>
                            </div>

                            <div>
                                <button class="btn ripple btn-primary my-4" type="submit">
                                    Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
