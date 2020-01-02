@extends('layouts.app')

@section('title')
    Companies List
@endsection

@section('content')
    <div class="row" xmlns:width="http://www.w3.org/1999/xhtml">
        <div class="col-12">
            <h1>Companies List</h1>
            <p><a href="{{ route('companies.create') }}">Add New Company</a></p>
        </div>
    </div>
    {{--
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
    --}}
    <table class="table table-bordered table-striped table-hover" >
        <caption>List of Companies</caption>
        @foreach($companies as $company)
            <tr style="text-align: center;">
                <td>{{ $company->id }}</td>
                <td><a href="{{ route('companies.show', ['company' => $company]) }}">{{ $company->name }}</a></td>
                <td>{{ $company->phone }}</td>
                <td style="width: 20%">{{ $company->contact_email }}</td>
            </tr>
        @endforeach
    </table>

@endsection
