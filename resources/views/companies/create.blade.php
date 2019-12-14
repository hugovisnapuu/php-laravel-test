@extends('layouts.app')

@section('title')
    Companies List
@endsection

@section('content')
    <div class="row">
        <div class="col-12">
            <h1>
                Add New Company
            </h1>
        </div>
    </div>

    <form action="{{ route('companies.store') }}" method="POST" style="max-width:50%;">
        @method('POST')
        <div class="form-group">
            <label for="name">Company name</label>
            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
            <div>{{ $errors->first('company_name') }}</div>
        </div>
        <div class="form-group">
            <label for="number" name="phone">Company contact number</label>
            <input type="text" name="phone" value="{{ old('phone') }}" class="form-control">
            <div>{{ $errors->first('phone') }}</div>
        </div>

        <button type="submit" class="btn btn-primary">Add company</button>
        @csrf
    </form>

@endsection