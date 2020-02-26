@extends('layouts.app')


@section('title')
    Customer List
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Customers List</h1>
            <p><a href="customers/create">Add New Customer</a></p>
        </div>
    </div>

    <table class="table table-bordered table-striped table-hover">
        <caption>List of Customers</caption>
        @foreach($customers as $customer)
                <tr style="text-align: center;">
                    <td>{{ $customer->id }}</td>
                    <td><a href="{{ route('customers.show', ['customer' => $customer]) }} ">{{ $customer->name }}</a></td>
                    <td>{{ $customer->company->name }}</td>
                    <td style="width: 20%;">{{ $customer->active }}</td>
                </tr>
        @endforeach
    </table>
    <br>
@endsection
