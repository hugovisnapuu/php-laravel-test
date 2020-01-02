@extends('layouts.app')

@section('title')
    Details for {{ $company->name }}
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>{{ $company->name }}</h1>

            <form action="{{ route('companies.destroy', ['company' => $company]) }}" method="POST">
                @method('DELETE')
                @csrf
                <button class="btn btn-danger" type="submit">Delete Customer</button>
            </form>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <p><strong>Name: </strong>{{$company->name}}</p>
            <p><strong>Email: </strong>{{$company->contact_email}}</p>
            <p><strong>Phone number: </strong>{{$company->phone}}</p>
        </div>
    </div>

    <div>
        <a href="{{ route('companies.edit', ['company' => $company]) }}">
            Edit company data
        </a>
    </div>
    <br>
    <div>
        <a href="{{ route('companies.index') }}">Back to Companies List</a>
    </div>
@endsection
