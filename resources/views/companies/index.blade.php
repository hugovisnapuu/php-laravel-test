@extends('layouts.app')

@section('title')
    Companies List
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>Companies List</h1>
            <p><a href="{{ route('companies.create') }}">Add New Company</a></p>
        </div>
    </div>
    
    @foreach ($companies as $company)
        <div class="row">
            <div class="col-4">
                {{ $company->id }}
            </div>
            <div class="col-4">
                <a href="{{ route('companies.show', ['company' => $company]) }}">{{ $company->name }}</a>
            </div>
            <div class="col 4">
                {{ $company->number }}
            </div>
            <hr>
        </div>
    @endforeach


@endsection