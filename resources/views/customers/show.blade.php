@extends('layouts.app')

@section('title')
    Details for {{$customer->name}}
@endsection

@section('content')
    <div class="row pb-3" >
        <div class="col-12">
            <h1>{{$customer->name}}</h1>

            <form action="{{ route('customers.destroy', ['customer' => $customer]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Delete Customer</button>
            </form>
        </div>
    </div>

    {{--<div class="row">
        <div class="col-12">
            <p><strong>Name: </strong>{{$customer->name}}</p>
            <p><strong>Email: </strong>{{$customer->email}}</p>
            <p><strong>Phone number: </strong>{{$customer->number}}</p>
            <p><strong>Status: </strong>{{ $customer->active }}</p>
            <p><strong>Company name: </strong> {{ $customer->company->name }}</p>
        </div>
        <div class="col-12">
            <div class="col-12">
                @if($customer->image != null)
                    <img src="{{ route('customers.picture', ['filename' => $customer->image]) }}" style="width:50px; " alt="image">

                @else
                    <p>Profile image not selected</p>
                @endif
            </div>
        </div>
    </div>--}}
    <div class="row">
        <div class="col-12">
            <p><strong>Name: </strong>{{$customer->name}}</p>
            <p><strong>Email: </strong>{{$customer->email}}</p>
            <p><strong>Phone number: </strong>{{$customer->number}}</p>
            <p><strong>Status: </strong>{{ $customer->active }}</p>
            <p><strong>Company name: </strong> {{ $customer->company->name }}</p>
                @if($customer->image != null)
                    <img src="{{ route('customers.picture', ['filename' => $customer->image]) }}" style="width:50px; " alt="image">

                    <form action="{{ route('customers.image.delete', ['customer' => $customer->id]) }}" method="POST">
                        @method('DELETE')
                        @csrf
                        <button class="btn btn-info my-2">Delete profile image</button>
                    </form>
                @else
                    <p>Profile image not selected</p>
                @endif
        </div>
    </div>

    <div>
        <a href="{{ route('customers.edit', ['customer' => $customer ]) }}">
            Edit customer data
        </a>
    </div>
    <br>
    <div>
        <a href="{{ route('customers.index', ['customer' => $customer]) }}">
            Back to Customer list
        </a>
    </div>

@endsection
