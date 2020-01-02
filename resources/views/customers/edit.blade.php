@extends('layouts.app')

@section('title')
    Edit Customer {{$customer->name}}
@endsection

@section('content')
<div class="row py-3">
    <div class="col-12">
        <h3>Edit Details for {{ $customer->name }}</h3>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <form action="{{ route('customers.update', ['customer' => $customer]) }}" method="POST" style="max-width:50%;" enctype="multipart/form-data">
            @method('PATCH')
            @include('customers.form')

            <button type="submit" value="reset" class="btn btn-primary ">
                Save changes
            </button>
        </form>
    </div>
</div>



@endsection
