@extends('layouts.app')

@section('title')
    Edit {{ $company->name }} Data
@endsection

@section('content')
<div class="row" class="py-3">
    <div class="col-12">
        <h3>Edit {{ $company->name }} Data</h3>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{ route('companies.update', ['company' => $company]) }}" method="POST" style="max-width:50%;">
            @method('PATCH')
            
            <div class="form-group">
                <label for="name">Company name</label>
                <input type="text" name="name" value="{{ old('name') ?? $company->name }}" class="form-control">
                <div>{{ $errors->first('company_name') }}</div>
            </div>
            <div class="form-group">
                <label for="number" name="phone">Company contact number</label>
                <input type="text" name="phone" value="{{ old('phone') ?? $company->phone }}" class="form-control">
                <div>{{ $errors->first('phone') }}</div>
            </div>

            <button type="submit" value="reset" class="btn btn-primary ">
                Save changes
            </button> 
            @csrf              
        </form>
    </div>
</div>
    
@endsection